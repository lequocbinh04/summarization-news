from summarization import *
from flask import Flask
from flask import request
import json
import cv2
import time as binh
import urllib.request
from flask_cors import CORS, cross_origin
app = Flask(__name__)
cors = CORS(app)
app.config['CORS_HEADERS'] = 'Content-Type'

@app.route('/')
@cross_origin()
def index():
    host = request.args.get('host')
    url  = request.args.get('url')
    summary, title, time, image = summarization(host, url)
    resp = urllib.request.urlopen(image)
    img = np.asarray(bytearray(resp.read()), dtype="uint8")
    img = cv2.imdecode(img, cv2.IMREAD_COLOR)
    millis = int(round(binh.time() * 1000))
    cv2.imwrite("../images/"+str(millis)+".png", img)
    ret = {
        "code": 200,
        "type": "success",
        "msg" : "Thành công",
        "data": {
            "title": title,
            "content": summary,
            "image": "http://localhost/generate_news_img/images/" + str(millis) + ".png",
            "time" : time 
        }
    }
    
    return ret
 
if __name__ == '__main__':
    app.run()

