# Imports
import cv2
import numpy as np
import os

# Make Canny Image and save it in Project Directory
def make_cannyedge(pic_name, pic_address):
	sigma = 0.3
	image = cv2.imread(pic_address)
	computed_median = np.median(image) 
	lower = int(max(0, (1.0 - sigma) * computed_median))
	upper = int(min(255, (1.0 + sigma) * computed_median))
	edged = cv2.Canny(image, lower, upper)
	canny_name = "/Applications/XAMPP/htdocs/hackathon/canny_uploaded/" + pic_name
	cv2.imwrite(canny_name, edged)

# Scan all files present in Directory Uploaded Photo
files = os.listdir("/Applications/XAMPP/htdocs/hackathon/uploaded_photo")
# Remove DS Store file
files.remove('.DS_Store')

# For each file, convert and Save Canny Image
for file in files:
	pic_name = file
	pic_address = "/Applications/XAMPP/htdocs/hackathon/uploaded_photo/" + pic_name
	make_cannyedge(pic_name , pic_address) 


