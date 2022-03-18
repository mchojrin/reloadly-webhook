build:
	docker build -t webhook .

start:
	docker run -v `pwd`/src:/var/www/html -d -p 8080:80 --rm --name=webhook webhook

stop:
	docker stop webhook