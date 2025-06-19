import os
import cv2
import numpy as np

def crop_faces_from_folder(input_folder):
    """
    Detects and crops faces from all images in a folder, resizes to 3.5cm x 4.5cm (413x531 px),
    compresses the images (~85% quality), and saves them in a folder named <original_folder>_cropped.

    Args:
        input_folder (str): Path to the folder with input images.
    """

    # Fixed model paths
    model_prototxt = r"E:\Python\ID_card_automation\deploy.prototxt.txt"
    model_weights = r"E:\Python\ID_card_automation\res10_300x300_ssd_iter_140000.caffemodel"

    # Create output folder
    parent_dir = os.path.dirname(input_folder)
    folder_name = os.path.basename(input_folder)
    output_folder = os.path.join(parent_dir, folder_name + "_cropped")
    os.makedirs(output_folder, exist_ok=True)

    # Load DNN model
    net = cv2.dnn.readNetFromCaffe(model_prototxt, model_weights)
    target_size = (413, 531)  # width x height in pixels

    for filename in os.listdir(input_folder):
        if filename.lower().endswith(('.jpg', '.jpeg', '.png')):
            image_path = os.path.join(input_folder, filename)
            image = cv2.imread(image_path)
            if image is None:
                print(f"⚠️ Unable to load {filename}")
                continue

            h, w = image.shape[:2]
            blob = cv2.dnn.blobFromImage(image, 1.0, (300, 300), [104, 117, 123], swapRB=False)
            net.setInput(blob)
            detections = net.forward()

            face_found = False
            for i in range(detections.shape[2]):
                confidence = detections[0, 0, i, 2]
                if confidence > 0.5:
                    face_found = True
                    box = detections[0, 0, i, 3:7] * np.array([w, h, w, h])
                    (x1, y1, x2, y2) = box.astype("int")

                    face_width = x2 - x1
                    face_height = y2 - y1

                    expand_w = int(face_width * 0.8)
                    expand_top = int(face_height * 0.8)
                    expand_bottom = int(face_height * 0.7)

                    new_x1 = max(0, x1 - expand_w)
                    new_y1 = max(0, y1 - expand_top)
                    new_x2 = min(w, x2 + expand_w)
                    new_y2 = min(h, y2 + expand_bottom)

                    cropped = image[new_y1:new_y2, new_x1:new_x2]
                    resized = cv2.resize(cropped, target_size)

                    save_path = os.path.join(output_folder, filename)
                    cv2.imwrite(save_path, resized, [cv2.IMWRITE_JPEG_QUALITY, 85])

                    print(f"✅ Saved: {save_path}")
                    break

            if not face_found:
                print(f"❌ No face detected in: {filename}")
