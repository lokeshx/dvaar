from requests import get
from bs4 import BeautifulSoup
import pandas as pd
import csv
headers = {"Accept-Language": "en-US, en;q=0.5"}

count =0
cse_links=[]
deptlinks=['https://www.iitr.ac.in/departments/AR/pages/People+Faculty_List.html','https://www.iitr.ac.in/departments/ASE/pages/People+Faculty+Faculty_Profiles.html','https://www.iitr.ac.in/departments/BT/pages/index.html','https://www.iitr.ac.in/departments/CH/pages/People+Faculty.html','https://www.iitr.ac.in/departments/CY/pages/People+Faculty_List.html','https://www.iitr.ac.in/departments/CY/pages/People+Faculty_List.html','https://www.iitr.ac.in/departments/CE/pages/People+Faculty_List.html','https://www.iitr.ac.in/departments/CSE/pages/index.html','https://www.iitr.ac.in/departments/EQ/pages/People+Faculty_List.html','https://www.iitr.ac.in/departments/ES/pages/People+Faculty_List.html','https://www.iitr.ac.in/departments/EE/pages/Faculty_List.html','https://www.iitr.ac.in/departments/ECE/pages/People+Faculty_List.html','https://www.iitr.ac.in/departments/HS/pages/People+Faculty_List.html','https://www.iitr.ac.in/departments/HY/pages/People+Faculty_List.html','https://www.iitr.ac.in/departments/DM/pages/People+Faculty.html','https://www.iitr.ac.in/departments/MA/pages/People+Faculty_List.html','https://www.iitr.ac.in/departments/ME/pages/People+Faculty.html','https://www.iitr.ac.in/departments/MT/pages/People+Faculty_List.html','https://www.iitr.ac.in/departments/DPT/pages/People+Faculty_List.html','https://www.iitr.ac.in/departments/PPE/pages/People+Faculty+Faculty_Profiles.html','https://www.iitr.ac.in/departments/PH/pages/People+Faculty_List.html','https://www.iitr.ac.in/departments/WRT/pages/People+Faculty_List.html']
for j2 in deptlinks:
	url = j2

	response = get(url , headers = headers)

	soup = BeautifulSoup(response.content , 'html.parser')
	fac_list=soup.find_all('div',class_="detail")

	
	for links in fac_list:
		cse_links.append("https://www.iitr.ac.in"+links.a['href'])

	for j3 in cse_links:
		print j3

# cse_links.pop()
# cse_links.pop()

csv_file= open('iitr_contacts_2.csv','w')
csv_writer=csv.writer(csv_file)
csv_writer.writerow(['Name','Designation','E-mail','Phone','Address','Department','Areas of Interest','Publications','Educational Qualifications','Professional Background','Sponsored Projects','Link to profile'])

for url1 in cse_links:

    if "cms.channeli" in url1:
    	print "f"
    	continue
    else:
    	response = get(url1 , headers = headers)
    	urldetf=url1.split("/")
    	print urldetf
    	urldet=urldetf[4]
    	if urldet=='AR':
    		dept="Architecture and Planning"
    	elif urldet=="ASE":
    		dept="Applied Science and Engineering"
    	elif urldet=="BT":
    		dept="Biotechnology"
    	elif urldet=="CH":
    		dept="Chemical Engineering"
    	elif urldet=="CY":
    		dept="Chemistry"
    	elif urldet=="CE":
    		dept="Civil Engineering"
    	elif urldet=="CSE":
    		dept="Computer Science and Engineering"
    	elif urldet=="EQ":
    		dept="Earthquake Engineering"
    	elif urldet=="ES":
    		dept="Earth Sciences"
    	elif urldet=="EE":
    		dept="Electrical Engineering"
    	elif urldet=="ECE":
    		dept="Electronics and Communication Engineering"
    	elif urldet=="HS":
    		dept="Humanities and Social Sciences"
    	elif urldet=="HY":
    		dept="Hydrology"
    	elif urldet=="DM":
    		dept="Management Studies"
    	elif urldet=="MA":
    		dept="Mathematics"
    	elif urldet=="ME":
    		dept="Mechanical and Industrial Engineering"
    	elif urldet=="MT":
    		dept="Metallurgical and Materials Engineering"
    	elif urldet=="DPT":
    		dept="Paper Technology"
    	elif urldet=="PPE":
    		dept="Polymer and Process Engineering"
    	elif urldet=="PH":
    		dept="Physics"
    	elif urldet=="WRT":
    		dept="Water Resources Development and Management"
    	else:
    		dept=""

    	print dept



    	# if response.status_code!=200:
    	# 	continue

    	soup = BeautifulSoup(response.content , 'html.parser')

    	details= soup.find('div', class_='details')
        img_s=soup.find_all('img')
        print img_s[1]['src']
        # img_source=img_s.find('img')
        # print img_source
        # print img_source

    	entries= details.find_all('span')
    	name=entries[0].text
    	position=entries[1].text
    	email=entries[2].text
    	phone=entries[3].text
        
        areas=soup.find('ul', class_="faculty_list")
        if areas is None:
        	areas_of_interest=[]
        else:
        	areas_of_interest=areas.li.text


        # csv_writer.writerow([name,position,email,phone])
    	print "Name:",name
    	print "Designation:",position
    	print "E-mail:",email
    	print "Phone:",phone

    	background=soup.find_all('div',class_="title pageTitle2")
    	for i in background:
    		if(i.text=="Professional Background"):
    			prof_b=i
        
        print "Professional Background:"
    	profb_table=prof_b.next_sibling
    	pbrows=profb_table.find_all('tr')


    	pbcolumns=[]
    	pbcolumns1=""
    	pbcolumnsf=""
        

    	for i in pbrows:
    		pbcolumns=(i.find_all('td'))
    		pbcolumns1=""
    		for j in pbcolumns:
    			pbcolumns1=pbcolumns1+"$"+j.text
    		pbcolumnsf=pbcolumnsf+"%"+pbcolumns1
    	# pbcolumnsf.pop(0)
    	# for j1 in pbcolumnsf:
    	# 	print j1
        

        print "Educational Details:"
    	##educational background
    	# background=soup.find_all('div',class_="title pageTitle2")
    	for i11 in background:
    		if(i11.text=="Educational Details"):
    			edu=i11
    			
    	# print edu.text

    	edu_n=edu.next_sibling
    	# print edu_n
    	edu_rows=edu_n.find_all('tr')
    	# print edu_rows
    	educolumns=[]
    	educolumns1=""
    	educolumnsf=""

    	for i13 in edu_rows:
    		educolumns=(i13.find_all('td'))
    		educolumns1=""
    		for j13 in educolumns:
    			educolumns1=educolumns1+"$"+j13.text
    		educolumnsf=educolumnsf+"%"+educolumns1
    	# educolumnsf.pop(0)
    	# for j14 in educolumnsf:
    	# 	print j14
        
        proj=[]
        for i41 in background:
        	if(i41.text=="Sponsored Research Projects"):
        		proj=i41
        projcolumns=[]
        projcolumns1=""
        projcolumnsf=""		
        # print edu.text
        if(len(proj)!=0):
        	proj_n=proj.next_sibling
        	# print edu_n
        	proj_rows=proj_n.find_all('tr')
        	# print edu_rows
        	

        	for i42 in proj_rows:
        		projcolumns=(i42.find_all('td'))
        		projcolumns1=""
        		for j41 in projcolumns:
        			projcolumns1=projcolumns1+"$"+j41.text
        		projcolumnsf=projcolumnsf+"%"+projcolumns1
        	# projcolumnsf.pop(0)
        	# for j42 in projcolumnsf:
        	# 	print j42


        csv_writer.writerow([name,position,email,"",phone,dept,''.join(areas_of_interest).encode('utf-8').strip(),"",''.join(educolumnsf).encode('utf-8').strip(),''.join(pbcolumnsf).encode('utf-8').strip(),''.join(projcolumnsf).encode('utf-8').strip(),url1,"IIT Roorkee",img_s[1]['src']])
     #    journu=[]
    	# print "Journal Papers:"
    	# for i21 in background:
    	# 	if(i21.text=="Refereed Journal Papers"):
    	# 		journu.append(i21)
    	# # journ_n=journ.next_sibling
    	# if(len(journu)!=0):
    	# 	# journu.pop()
    	# 	journ_list=journu.find_next('ol')
    	# 	journ_l=journ_list.find_all('li')
    	# 	journf=[]
    	# 	for i31 in journ_l:
    	# 		journf.append(i31.text)

    	# 	for i32 in journf:
    	# 		print i32
    	# 	print "\n"

    	


