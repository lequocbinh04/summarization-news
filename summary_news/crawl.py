import requests
from bs4 import BeautifulSoup
from datetime import datetime
def getVnexpress(url):
    response = requests.get(url)
    soup     = BeautifulSoup(response.content, "html.parser")
    title    = soup.find("h1", class_="title-detail").text
    body     = soup.find_all("p", class_ = "Normal")
    str      = soup.find("p", class_="description").text + " "
    image    = soup.find("meta", {"property" : "og:image"}).get('content')
    time     = soup.find(class_="date").text.replace("(GMT+7)", "")
    for data in body:
        str = str + data.text + " "

    return str, title, time, image

def getDantri(url):
    response = requests.get(url)
    soup     = BeautifulSoup(response.content, "html.parser")
    title    = soup.find("h1", class_="dt-news__title").text.strip()
    des      = soup.find("div", class_ = "dt-news__sapo")
    str      = des.find("h2").text + " "
    wrapper  = soup.find(class_ = "dt-news__content")
    image    = soup.find("meta", {"property" : "og:image"}).get('content')
    time     = soup.find(class_ = "dt-news__time").text

    for data in wrapper.find_all("p"):
        str = str + data.text + " "
    return str, title, time, image

def getTuoiTre(url):
    response = requests.get(url)
    soup     = BeautifulSoup(response.content, "html.parser")
    title    = soup.find("h1", class_ = "article-title").text.strip()
    str      = soup.find("h2", class_ = "sapo").text.strip()
    body     = soup.find(id = "main-detail-body")
    time     = soup.find(class_ = "date-time").text.replace("GMT+7", "").strip()
    image    = soup.find("meta", {"property" : "og:image:secure_url"}).get('content')

    for data in body.find_all("p"):
        if(data.has_attr('data-placeholder')):
            continue
        str += data.text
    return str, title, time, image
(getVnexpress("https://vnexpress.net/thu-tuong-nhat-suga-den-ha-noi-4178012.html"))