# Stage 1: Build the Spring Boot application using Gradle with Java 8
FROM gradle:7.6-jdk8 as builder

# Set working directory
WORKDIR /app

# Copy build files
COPY . .

# Build the application
RUN gradle build -x test --no-daemon

# Second stage - WildFly server with Jakarta EE support
FROM jboss/wildfly:14.0.1.Final

# Set environment variables
ENV WILDFLY_USER admin
ENV WILDFLY_PASS adminPassword

# Add custom standalone configuration if needed
COPY standalone.xml /opt/jboss/wildfly/standalone/configuration/

# Add WildFly management user
USER root
RUN /opt/jboss/wildfly/bin/add-user.sh -u $WILDFLY_USER -p $WILDFLY_PASS --silent

# Copy the built application from the builder stage
COPY --from=builder /app/build/libs/*.war /opt/jboss/wildfly/standalone/deployments/myapp.war

# Create a script that can rebuild the application if needed
COPY rebuild.sh /opt/jboss/

# Make the rebuild script executable
RUN chmod +x /opt/jboss/rebuild.sh

# Switch back to jboss user
USER jboss

# Expose WildFly ports
EXPOSE 8080 9990

# Run WildFly
CMD ["/opt/jboss/wildfly/bin/standalone.sh", "-b", "0.0.0.0", "-bmanagement", "0.0.0.0"]