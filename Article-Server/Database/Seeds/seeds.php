<?php
require_once("../../Connection/connection.php");

$questions = [
    "What was the 10+ Deploys Per Day model, and who introduced it?",
    "Why was the 10+ Deploys Per Day model significant?",
    "What is DevOps, and how is it related to the Flickr model?",
    "What is DevOps, and how is it related to the Flickr model?",
    "How did Flickr change the traditional deployment approach?",
    "What role did automation play in Flickr’s deployment strategy?",
    "What is the importance of feature flags in Flickr’s model?",
    "Why was real-time monitoring critical in Flickr’s deployment strategy?",
    "How did Flickr ensure smooth collaboration between developers and operations?",
    "What rollback strategies did Flickr implement?",
    "How did Flickr’s model influence modern CI/CD pipelines?",
    "How did the 10+ Deploys Per Day model reduce risks in software deployment?",
    "What were the collaboration improvements brought by DevOps?",
    "How did frequent deployments improve time to market?",
    "Why is monitoring considered a core DevOps principle today?",
    "How have DevOps tools evolved since Flickr’s model?",
    "What industries benefit the most from DevOps today?",
    "How does DevOps contribute to business agility?",
    "What are some challenges companies face when adopting DevOps?",
    "What is the future of DevOps?"
];

$answers = [
    "It was a continuous deployment model introduced by John Allspaw and Paul Hammond at the Velocity Conference in 2009.",
    "It demonstrated how frequent, small deployments could improve software development efficiency and reduce risks, leading to the DevOps movement.",
    "DevOps is a methodology that integrates development and IT operations to improve software delivery speed and reliability. Flickr's model was one of the first real-world implementations of DevOps principles.",
    "Lengthy deployment cycles, high failure rates, rollback difficulties, and slow bug resolution due to the separation between development and operations teams.",
    "By adopting small, frequent deployments instead of large, infrequent releases, reducing risks and enabling faster issue resolution.",
    "Automation enabled multiple daily deployments, reducing reliance on manual processes and minimizing human error.",
    "Feature flags allowed selective activation of features in production, enabling controlled rollouts and testing without separate environments.",
    "It helped detect issues immediately, allowing quick responses and ensuring system stability.",
    "By breaking down silos, encouraging shared responsibilities, and having operations engineers work closely with developers.",
    "They had quick rollback mechanisms to revert to a previous stable state in case of deployment failures.",
    "It laid the foundation for Continuous Integration and Continuous Deployment (CI/CD), which are now industry standards.",
    "Smaller, frequent changes made it easier to identify and fix issues without major disruptions.",
    "It eliminated barriers between development and operations, improving communication and efficiency.",
    "Features and bug fixes could be released rapidly, ensuring faster delivery to users.",
    "Continuous monitoring ensures system reliability, allowing teams to proactively detect and resolve issues.",
    "Modern tools like Kubernetes, Docker, Jenkins, and GitHub Actions have automated deployment, scaling, and monitoring.",
    "Tech companies, financial institutions, healthcare, and e-commerce businesses benefit from faster and more reliable software deployment.",
    "It enables organizations to quickly adapt to market changes by delivering new features and updates faster.",
    "Cultural resistance, lack of automation expertise, and difficulty integrating legacy systems.",
    "DevOps is evolving with AI-driven automation, GitOps, and increased emphasis on security (DevSecOps)."
];

$query = $conn->prepare("SELECT * FROM questions WHERE question = ?");

$insertQuery = $conn->prepare("INSERT INTO questions (question, answer) VALUES (?, ?)");

for ($i = 0; $i < count($questions); $i++) {
    $query->bind_param("s", $questions[$i]);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows === 0) {
        $insertQuery->bind_param("ss", $questions[$i], $answers[$i]);
        $insertQuery->execute();
    }
}
?>
