import sys
import json
import requests
image_path = sys.argv[1]

with open('types.json', encoding='utf-8') as data_file:
    data = json.loads(data_file.read())
#data= {'id' : 'elbow_pos' , 'type' : 'elbow'}
image = open(image_path,'rb')

files = {'image' : image}
response = requests.post('http://c2ec3c8e.ngrok.io/predict',data = data  , files = files).json()
print (json.dumps(response))
f = open("process.json", "w")
f.write(json.dumps(response))
