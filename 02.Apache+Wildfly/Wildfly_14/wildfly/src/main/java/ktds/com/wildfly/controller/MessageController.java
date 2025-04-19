package ktds.com.wildfly.controller;

import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.*;

@Controller
public class MessageController {

    // Handle GET request to display form
    @GetMapping("/")
    public String home(Model model) {
        model.addAttribute("message", "Hello from WildFly server!");
        return "index";
    }

    // Handle GET request to get text from server
    @GetMapping("/message")
    public String getMessage(Model model) {
        model.addAttribute("message", "This is a sample message from the server");
        return "message";
    }

    // Handle POST request to send and receive text
    @PostMapping("/message")
    public String postMessage(@RequestParam("text") String text, Model model) {
        // Simply echo back the same text
        model.addAttribute("submittedText", text);
        model.addAttribute("responseText", "Server received: " + text);
        return "response";
    }
}