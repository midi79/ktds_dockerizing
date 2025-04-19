#!/bin/bash

# Script to rebuild the application inside the container
# This is useful for development or when you need to make changes without rebuilding the entire image

echo "Rebuilding Spring Boot application..."

# Check if source code is available
if [ ! -d "/app/src" ]; then
  echo "Error: Source code not found. Please mount the source directory to /app/src"
  exit 1
fi

# Set up working directory
mkdir -p /tmp/build
cd /tmp/build

# Copy source files
cp -r /app/src ./src
cp /app/build.gradle ./build.gradle
if [ -f "/app/settings.gradle" ]; then
  cp /app/settings.gradle ./settings.gradle
fi

# Build the application
echo "Running Gradle build..."
gradle build -x test --no-daemon

# Check if the build was successful
if [ $? -ne 0 ]; then
  echo "Build failed!"
  exit 1
fi

# Deploy the new WAR file
echo "Deploying new WAR file..."
cp build/libs/*.war /opt/jboss/wildfly/standalone/deployments/myapp.war

echo "Rebuild and deployment completed successfully!"