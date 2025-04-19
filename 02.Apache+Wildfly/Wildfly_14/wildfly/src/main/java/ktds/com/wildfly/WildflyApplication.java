package ktds.com.wildfly;

import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.boot.web.servlet.support.SpringBootServletInitializer;
import org.springframework.boot.builder.SpringApplicationBuilder;

@SpringBootApplication
public class WildflyApplication extends SpringBootServletInitializer {

	@Override
	protected SpringApplicationBuilder configure(SpringApplicationBuilder application) {
		return application.sources(WildflyApplication.class);
	}

	public static void main(String[] args) {
		// This main method is only used when running as a JAR
		// For WAR deployment to WildFly, the configure method above is used
		SpringApplication.run(WildflyApplication.class, args);
	}
}