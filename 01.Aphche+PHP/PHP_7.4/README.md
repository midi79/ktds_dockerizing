# How to run

docker build -t php74-apache-demo .

docker run -p 8080:80 php74-apache-demo

-> http://localhost:8080


# Check Apache version

docker exec -it <container_name_or_id> apache2 -v
