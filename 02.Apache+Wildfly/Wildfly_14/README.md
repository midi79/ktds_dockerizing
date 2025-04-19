# How to run

./gradlew clean build

docker build -t midi79/apache:2.4 .
docker build -t midi79/wildfly:14.0 .

docker push midi79/apache:2.4
docker push midi79/wildfly:14.0

helm install myapp ./helm-chart

-> http://localhost:8080


# Check Apache version

docker exec -it <container_name_or_id> apache2 -v
