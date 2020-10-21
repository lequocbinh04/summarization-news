import nltk
from gensim.models import KeyedVectors 
from pyvi import ViTokenizer
import numpy as np
from sklearn.cluster import KMeans
from sklearn.metrics import pairwise_distances_argmin_min
from crawl import *
def summarization(host, url):
    #pre-process
    
    if(host == "dantri"):
        content, title, time, image = getDantri(url)
    elif(host == "tuoitre"):
        content, title, time, image = getTuoiTre(url)
    elif(host == "vnexpress"):
        content, title, time, image = getVnexpress(url)
    

    contents_parsed = content.lower() 
    contents_parsed = contents_parsed.replace('\n', '. ') 
    contents_parsed = contents_parsed.strip()
    contents_parsed = contents_parsed.replace('..', '. ')

    originalString = content.replace('\n', '. ').strip().replace('..', '. ').split(' ')
    saveOriginal = {}
    for word in originalString:
        saveOriginal[word.lower()] = word



    sentences = nltk.sent_tokenize(contents_parsed) #tách câu
    len_max_sentences = len(max(sentences, key = len))
    if(len_max_sentences > 500):
        n_clusters = 1
    elif len_max_sentences > 300:
        n_clusters = 2
    else:
        n_clusters = 3

    w2v = KeyedVectors.load_word2vec_format("vi_txt/vi.vec")

    vocab = w2v.vocab #List vocabulary


    X = []
    for sentence in sentences:
        sentence_tokenized = ViTokenizer.tokenize(sentence)
        words = sentence_tokenized.split(" ")
        sentence_vec = np.zeros((100))
        for word in words:
            if word in vocab:
                sentence_vec+=w2v[word]
        X.append(sentence_vec)
        

    kmeans = KMeans(n_clusters=n_clusters)
    kmeans = kmeans.fit(X)

    avg = []
    for j in range(n_clusters):
        idx = np.where(kmeans.labels_ == j)[0]
        avg.append(np.mean(idx))
    closest, _ = pairwise_distances_argmin_min(kmeans.cluster_centers_, X)
    ordering = sorted(range(n_clusters), key=lambda k: avg[k])
    summary = ' '.join([sentences[closest[idx]] for idx in ordering])

    #Xử lí sau khi đã summarization
    summary = summary.replace('. .', '. ')
    summary = summary.strip()
    summary = summary.strip('.')
    arrSummary = summary.split(' ')
    summary = ""
    for word in arrSummary:
        if(word != " "):
            summary = summary + " "
        try:
            summary = summary + saveOriginal[word]
        except:
            summary = summary + word
    summary = summary.replace('  ', ' ')
    summary = summary.strip()
    summary = summary.strip('.')
    summary_split = summary.split(". ")
    summary = []
    for i in summary_split:
        i = list(i)
        i[0] = i[0].upper()
        i = "".join(i)
        summary.append(i)
    summary = ". ".join(summary)
    summary = summary.strip('.')
    summary += '.'
    summary = summary.replace('  ', ' ')

    return summary, title, time, image   
