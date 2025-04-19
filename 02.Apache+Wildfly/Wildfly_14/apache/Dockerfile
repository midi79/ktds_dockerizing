# Apache HTTP Server base image
FROM httpd:2.4

# Install required packages
RUN apt-get update && \
    apt-get install -y curl && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

# Copy custom httpd configuration
COPY httpd.conf /usr/local/apache2/conf/httpd.conf

# Set working directory
WORKDIR /usr/local/apache2/htdocs

# Expose port
EXPOSE 80

# Health check
HEALTHCHECK --interval=30s --timeout=3s CMD curl -f http://localhost/ || exit 1

CMD ["httpd-foreground"]