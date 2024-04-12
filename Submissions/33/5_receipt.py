#import libraries
from selenium import webdriver
import pandas as pd
import re
data = []  # create an empty list to store data
python_data=[]
driver = webdriver.Chrome(executable_path='G:/Sagar Python/SagarPython/zomato/chromedriver')  #Use webdriver


def get_totno_pages():   # function to calculate total openings in python
    driver.get("https://www.naukri.com/python-jobs-in-pune")
    tot_page = driver.find_elements_by_xpath('//span[@class="cnt"]')
    page_no = tot_page[0].text.split(' ')[-1]
    pages = int(int(page_no)/50)
    return pages


def get_all_data():    # fetch data
    a=get_totno_pages()
    for i in range(1,a+2):
        if(i==1):
            driver.get("https://www.naukri.com/python-jobs-in-pune")
        else:
            driver.get("https://www.naukri.com/python-jobs-in-pune"+"-"+str(i))

        desig=driver.find_elements_by_xpath('//li[@class="desig"]')
        org= driver.find_elements_by_xpath('//span[@class="org"]')
        exp=exp = driver.find_elements_by_xpath('//span[@class="exp"]')

        for i in range(int(len(desig))):
            d = {}
            d["DESIGNATION"]=desig[i].text
            d["ORGANISATION"]=org[i].text
            d["EXPIRIENCE"]=exp[i].text
            data.append(d)
    return data

def data_to_csv():  # data store into csv process
    get_all_data()
    df1 = pd.DataFrame(data)
    df1.to_csv("python_jobs_in_pune.csv", index=False)


data_to_csv()

def python_freshers():
    for x in data:
        if (re.findall(r'[\d]+', x['EXPIRIENCE']))[0] == '0':
            python_data.append(x)
    return python_data


def data_to_csv1():  # freshers_opening_data store into csv process
    python_freshers()
    df1 = pd.DataFrame(python_data)
    df1.to_csv("python_jobs_in_pune_freshers.csv", index=False)

data_to_csv1()

driver.close()
csv_file = pd.read_csv("python_jobs_in_pune.csv")
csv_file1= pd.read_csv("python_jobs_in_pune_freshers.csv")
csv_file
csv_file1
