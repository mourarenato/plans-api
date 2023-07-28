fileMode: ##Sets git fileMode to false
	@echo "Configuring git fileMode to false"
	git config core.fileMode false

files: ##@Copy files and set permissions
	sudo chmod 777 -R *
	sudo cp docker-compose.example.yml docker-compose.yml

start: ###Up containers
	docker-compose up -d

install: ##Install dependencies
	@echo "Installing dependencies"
	docker-compose up -d
	sudo chmod 777 -R vendor/
	make files

restart: ##Restart server
	docker-compose down;docker-compose up -d
