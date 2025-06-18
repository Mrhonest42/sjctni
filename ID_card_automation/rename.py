import os

def rename_images(folder_path, batch, degree, dept, start_roll, end_roll, skip_rolls=[]):
    # List all JPG files and sort them
    files = [f for f in os.listdir(folder_path) if f.lower().endswith('.jpg')]
    files.sort()
    print(f"Found {len(files)} images.")  # Debug: Confirm file count

    current_roll = start_roll
    renamed_count = 0

    for old_name in files:
        # Skip reserved roll numbers or if we exceed the end_roll
        while current_roll in skip_rolls or current_roll > end_roll:
            current_roll += 1
        
        if current_roll > end_roll:
            break  # Stop if no more rolls left
        
        # Generate new filename (e.g., "25uma101.jpg")
        new_name = f"{batch}{degree}{dept}{current_roll}.jpg"
        os.rename(
            os.path.join(folder_path, old_name),
            os.path.join(folder_path, new_name)
        )
        renamed_count += 1
        current_roll += 1

    print(f"Renamed {renamed_count} images. Skipped rolls: {skip_rolls}")

# Example Usage:
rename_images(
    folder_path="E:\Python\ID_card_automation\images",  # Replace with your folder path
    batch="25",
    degree="u",
    dept="ma",
    start_roll=101,
    end_roll=112,
    skip_rolls=[105, 109]  # These rolls will be skipped
)
