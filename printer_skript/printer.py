#!/usr/bin/python3

import StarTSPImage
from PIL import Image, ImageDraw, ImageFont
import requests 
import glob
from datetime import datetime

SERVER = "veselica.kralj.io"
DIR = "/opt/veselica"
#DIR = "."

VB_NASLOV  = 5
VB_ARTIKEL = 20
VB_DODATEK = 10

def zapisi_error(e):
	f = open(f"{DIR}/error.log", "a")
	f.write(f"{datetime.now()}; {e}\n")
	f.close()

def log(l):
	f = open(f"{DIR}/print.log", "a")
	f.write(f"{datetime.now()}; {l}\n")
	f.close()

try:
	response = requests.get(f"https://{SERVER}/kuhinja.php", timeout=5)
	response.raise_for_status()

except requests.exceptions.RequestException as e:
	print(f"Napaka pri komunikaciji s strežnikom {e}")
	zapisi_error("TIMEOUT /kuhinja.php")
	exit(0)

narocila = response.json()

if(len(narocila) == 0):
	print(f"Ni novih naročil")
	exit(0)

printerji = glob.glob("/dev/usb/lp*")

if(len(printerji) == 0):
	print("Napaka: Tiskalnik ni povezan!")
	exit(0)

print(f"Povezujem tiskalnik {printerji[0]}")

printer = open(printerji[0], "wb")

print("Tiskalnik povezan!")

miza_font = ImageFont.truetype(f'{DIR}/Roboto-Bold.ttf', 100)
jed_font = ImageFont.truetype(f'{DIR}/Roboto-Regular.ttf', 40)
dodatki_font = ImageFont.truetype(f'{DIR}/Roboto-Regular.ttf', 30)
info_font = ImageFont.truetype(f'{DIR}/Roboto-Regular.ttf', 20)

zamik_pozicije = {
	"0": 60,
	"1": 100
}

for n in narocila:
	print(f"Tiskam naročilo {n['id']} miza {n['miza']}")

	visina_pozicij = 0
	for pozicija in n["pozicija"]:
		visina_pozicij += zamik_pozicije[pozicija["ima_dodatke"]]

	image = Image.new('RGB', (500, visina_pozicij + 150 + 40), color='White')
	d = ImageDraw.Draw(image)
	
	d.text((0, 0), f"Miza { n['miza'] }", font=miza_font, fill=(0,0,0))
	d.text((0, 105), f"Natakar: {n['uporabnik']}      {n['cas']}", font=info_font, fill=(0,0,0))

	trenutni_zamik = 0

	for i, aa in enumerate(n['pozicija']):
		d.text((0, 145 + trenutni_zamik), f"{aa['kolicina']}x {aa['naziv']}", font=jed_font, fill=(0,0,0))
		trenutni_zamik += 60
		if aa["ima_dodatke"] == "1":
			if len(aa["dodatek"]) == 0:
				tekst = "Brez dodatkov"
			else:
				tekst = ", ".join(aa["dodatek"])
			d.text((40, 145 + trenutni_zamik), tekst, font=dodatki_font, fill=(0,0,0))
			trenutni_zamik += 40

	raster = StarTSPImage.imageToRaster(image, cut=True)
	printer.write(raster)
 
	#image.save("narocilo.jpg")

	feedback = False
	while not feedback:
		try:
			r = requests.get(f"https://{SERVER}/obdelano_narocilo.php?narocilo="+n["id"], timeout=5)
			r.raise_for_status()

			if r.status_code == 200:
				feedback = True
		except requests.exceptions.RequestException as e:
			zapisi_error("TIMEOUT obdelano_narocilo.php?narocilo="+n["id"])
			print(f"Napaka pri feedbacku: {e}")

	log(f"Natisnil {n['id']} miza {n['miza']}")

printer.close()