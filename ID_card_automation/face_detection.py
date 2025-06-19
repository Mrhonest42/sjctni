import cv2
import numpy as np
import os

# Folder paths
input_folder = r"F:\Input\input"
output_folder = r"F:\Input\output"

# Create output folder if it doesn't exist
os.makedirs(output_folder, exist_ok=True)

# Load the DNN face detection model
net = cv2.dnn.readNetFromCaffe('deploy.prototxt', 'res10_300x300_ssd_iter_140000.caffemodel')

# Process each image
for filename in os.listdir(input_folder):
    if filename.lower().endswith(('.jpg', '.jpeg', '.png')):
        image_path = os.path.join(input_folder, filename)
        image = cv2.imread(image_path)
        if image is None:
            print(f"⚠️ Unable to load {filename}")
            continue

        (h, w) = image.shape[:2]

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
                expand_bottom = int(face_height * 0.7)  # reduced chest coverage 👈

                new_x1 = max(0, x1 - expand_w)
                new_y1 = max(0, y1 - expand_top)
                new_x2 = min(w, x2 + expand_w)
                new_y2 = min(h, y2 + expand_bottom)

                cropped = image[new_y1:new_y2, new_x1:new_x2]

                save_path = os.path.join(output_folder, f"crop_{filename}")
                cv2.imwrite(save_path, cropped)
                print(f"✅ Cropped with reduced bottom and saved: {filename}")
                break

        if not face_found:
            print(f"❌ No face detected in: {filename}")
