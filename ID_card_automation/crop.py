import cv2
from PIL import Image
import os

# Set your folders
input_folder = r'E:\Python\ID_card_automation\cropImg'     # Folder containing original images
output_folder = r'E:\Python\ID_card_automation\fineImg'    # Folder to save cropped images
os.makedirs(output_folder, exist_ok=True)

def detect_and_crop_face(image_path, output_path, crop_size=(300, 400)):
    image = cv2.imread(image_path)
    gray = cv2.cvtColor(image, cv2.COLOR_BGR2GRAY)

    # Load Haar Cascade face detector
    face_cascade = cv2.CascadeClassifier(cv2.data.haarcascades + "haarcascade_frontalface_default.xml")
    faces = face_cascade.detectMultiScale(gray, scaleFactor=1.1, minNeighbors=5)

    if len(faces) == 0:
        print(f"No face detected in {image_path}")
        return

    (x, y, w, h) = faces[0]
    face_center_x = x + w // 2
    face_center_y = y + h // 2

    crop_w, crop_h = crop_size
    x1 = max(face_center_x - crop_w // 2, 0)
    y1 = max(face_center_y - crop_h // 2, 0)
    x2 = x1 + crop_w
    y2 = y1 + crop_h

    # Crop and save
    cropped = image[y1:y2, x1:x2]
    pil_image = Image.fromarray(cv2.cvtColor(cropped, cv2.COLOR_BGR2RGB))
    pil_image.save(output_path)
    print(f"✔ Cropped image saved: {output_path}")

# Process each image
for filename in os.listdir(input_folder):
    if filename.lower().endswith(('.jpg', '.jpeg', '.png')):
        input_path = os.path.join(input_folder, filename)
        output_path = os.path.join(output_folder, filename)
        detect_and_crop_face(input_path, output_path)
