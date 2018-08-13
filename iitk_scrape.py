from requests import get 
from bs4 import BeautifulSoup
import pandas as pd
import csv 
import re

headers = {"Accept-Language": "en-US, en;q=0.5"}
url= 'http://www.iitk.ac.in/new/iitk-faculty'
s="http://www.iitk.ac.in"
response = get (url, headers= headers)
# print response.status_code
soup = BeautifulSoup(response.content ,'html.parser')
# print soup.prettify()
links = []
c=0
csv_file=open('1_contacts.csv','w')
csv_writer=csv.writer(csv_file)
csv_writer.writerow(['Name','Designation','E-mail','Phone','Address','Department','Areas of Interest','Publications','Educational Qualifications','Professional Background','Sponsored Projects','Link to profile'])

# x= soup.find_all('div',class_='frcard')
# print x

for div in soup.find_all('div',class_='frcard'):
	a = div.find_all('a')[0]
	#print 'b'
	if c == 0 :
		c=1
		continue
	else :
		s1= s+a.attrs['href'] 
		links.append(s1)
# for i in links:
# 	print i
# temp = []
# headers=['Name','Department','Research','Publication','Education','office address','office phone','email']

# print links
for i in links:
	

	
	response1 = get(i, headers=headers)
	soup1 = BeautifulSoup(response1.content , 'html.parser')
	img_s=soup1.find('div',class_='fac-image')
	# print img_s
	img_source=img_s.find('img')['src']
	img_source="http://iitk.ac.in"+img_source
	print img_source

	#print soup1.prettify()
	print i
	name_box = soup1.find('h3', class_='head1')
	name=""
	if name_box is None:
		name="null"
	 	continue 
	else:
		name= name_box.text.strip()
	dep=soup1.find('div',class_='ri').find_all('tr')
	# x=dep[2]
	# print x
	department= dep[2].find(text=re.compile("Department"))
	if department is not None:
		department=department+","
		departmentf=department.split(',')
	else:
		departmentf=["",""]
	print departmentf
	# print department
	# str1=""
	# k=1
	# department=[]
	# for j in dep:
	# 	if j=="\n":
	# 		if k==0 :
	# 			continue
	# 		department.append(str1)
	# 		str1=""
	# 		k=0
	# 		continue
	# 	else :
	# 		str1+=i
	# 		k = 1
    
	r = soup1.find_all('div', class_='ri')[1]
	if len(r.find_all('p')) !=1 :
		res=r.find_all('p')[1]
		researchf=res.text
		research=researchf.split(",")

		# research.replace("-",":")
	else:
		research="none"
	pub = soup1.find('div',class_='accordiancard')
	
	publication1 =['Empty']
	publicationf =""
	for j in pub.find_all('li'):
		if j.p != None:
			publication1.append(j.p.text+"%")
	if len(publication1)==0:
		publication1="none"
	else:
		publication1.pop(0)
	# for j in publication1:
	# 	publicationf+= j+"\n"
	# publication=publicationf.split(",\n")


	off_add=""
	off_phone=""
	email_add=""
	off_ad = soup1.find('p',class_='ci-text')
	if off_ad is None :
		off_add="none"
	else:
		off_add=off_ad.text.strip()


	off_p = soup1.find_all('p',class_='fac-email')[1].text.strip()
	if off_p is None :
		off_phone="none"
	else:
		off_phone=off_p.split(':')[1].strip()

	
	email=soup1.find('p',class_='fac-email').text.strip()
	if email is None:
		email_add="none"
	else:
		#
		email_add=email.split(":")[1].strip()
		# print email_add

	educ = soup1.find('div',class_='tabletext')
	# print educ
	education1 =['empty']
	educationf =""
	for j in educ.find_all('li'):
		if j == None:
			break
		jf=j.text
		education1.append(jf+"%")
	if len(education1)==0:
		education1="none"
	else:
		education1.pop(0)



	# for j in education1:
	# 	educationf = j+","
	# education=educationf.split(",")
	# print education
	# education1 = str(education).strip('u')
	# publication1 = str(publication).strip('u')

	# print research
	#print publication
	#print education
	# print off_add
	# print off_phone
	# # print email
	# print i
	#print off_phone

	#sub = pd.concat([name,department[4],research,publication,education,off_add,off_phone,email_add], axis = 1)
	#temp.append(sub)
	
	# print dep
     


	csv_writer.writerow([''.join(name).encode('utf-8').strip(),''.join(departmentf[0]).encode('utf-8').strip(),''.join(email_add).encode('utf-8').strip(),''.join(off_phone).encode('utf-8').strip(),''.join(off_add).encode('utf-8').strip(),''.join(departmentf[1]).encode('utf-8').strip(),''.join(researchf).encode('utf-8').strip(),''.join(publication1).encode('utf-8').strip(),''.join(education1).encode('utf-8').strip(),"","",''.join(i).encode('utf-8').strip(),'IIT Kanpur',img_source])
#sub.to_csv("iit_records.csv",index=False,header=False)

csv_file.close()

	




