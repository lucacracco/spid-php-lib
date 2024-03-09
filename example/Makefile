init:
	# Configure SP
	openssl req -x509 -nodes -sha256 -days 365 -newkey rsa:2048 -subj "/C=IT/ST=Italy/L=Rome/O=myservice/CN=localhost" -keyout ./sp.key -out ./sp.crt
	chmod 666 ./sp.key ./sp.crt
	# Needed only to interact with the production IdPs:
	# ../bin/download_idp_metadata.php idp_metadata

test-spid:
	docker compose up -d
	docker compose exec web bash -c "composer install --prefer-dist --no-progress"
	docker compose exec spid_sp_test bash -c "spid_sp_test --idp-metadata > /var/www/html/example/idp_metadata/spid-sp-test.xml"
	docker compose exec spid_sp_test bash -c "spid_sp_test --metadata-url http://sp.docker.localhost/metadata --extra -rf html -o /var/www/html/example/reports/metadata"
	for profile in 'saml2-sp' 'spid-sp-public'; do \
  		docker compose exec spid_sp_test bash -c "spid_sp_test --profile $$profile --metadata-url http://sp.docker.localhost/metadata --authn-url http://sp.docker.localhost/login?selected_idp=spid-sp-test --extra -rf html -o /var/www/html/example/reports/$$profile"; \
  	done; \
  	docker compose down

clean:
	rm -f sp.key
	rm -f sp.crt
	rm -f idp_metadata/*.xml
	rm -rf reports/*/
	rm -f idp_metadata/spid-sp-test.xml
