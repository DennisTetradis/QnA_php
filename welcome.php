<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Main</title>
    <link rel="stylesheet" href="./css/style.css" />
  </head>
  <body>

    <button class="light_button" onclick="handleClick()">Dark/Light</button>
    <script src="theme.js"></script>

    <div class="accordion">
      <div class="accordion-header">
        <h3>About</h3>
        <button class="accordion-toggle"></button>
      </div>
      <div class="accordion-content">
        <p>Welcome to my page!</p>
        <p>Here you can make your technical questions and get your answers.</p>
        <p>Kind of like stackover flow but better! K.</p>
      </div>
      <div class="accordion-header">
        <h3>LogIn/SignUp</h3>
        <button class="accordion-toggle"></button>
      </div>
      <div class="accordion-content">
        <h2>To login or signup to our platform, follow these steps:</h2>
        <ol>
          <li>
            <p>Navigate to the login page on our website.</p>
            <a href="http://localhost:3000/signin.php">SignIn</a>
          </li>
          <li>
            <p>
              If you are a new user, click on the "Sign Up" button and provide
              your email address and a password of your choice.
            </p>
            <a href="http://localhost:3000/signup.php">SignUp</a>
            <p>
              If you are an existing user, enter your email and password in the
              login fields.
            </p>
          </li>
          <li>
            <p>
              After entering your details, click on the "Login" or "Sign Up"
              button to proceed.
            </p>
          </li>
          <li>
            <p>
              If you are signing up for the first time, you may be asked to
              verify your email address by clicking on a link sent to your
              email.
            </p>
          </li>
          <li>
            <p>
              Once you have successfully logged in or signed up, you will be
              directed to your account dashboard where you can access all the
              features of our platform. Please ensure that you keep your login
              details confidential and do not share them with anyone. If you
              have any trouble logging in or signing up, please contact our
              customer support team for assistance.
            </p>
          </li>
        </ol>
      </div>
      <div class="accordion-header">
        <h3>Help</h3>
        <button class="accordion-toggle"></button>
      </div>
      <div class="accordion-content">
        <h1>Welcome to our Website</h1>
        <p>
          This is a community-driven platform for asking and answering questions
          related to various topics. Our platform is designed to be simple and
          user-friendly, so you can easily find the answers you need.
        </p>

        <h2>How to Use our Website</h2>
        <ol>
          <li>
            <p>
              Asking a Question: If you have a question, simply click on the
              "Ask a Question" button and provide a clear and concise title and
              description of your question. Be sure to select the relevant
              category for your question to help others find it more easily.
            </p>
          </li>
          <li>
            <p>
              Answering a Question: If you have knowledge or expertise on a
              particular topic, you can help others by answering their
              questions. Simply navigate to the question you want to answer and
              click on the "Answer" button. Be sure to provide a clear and
              detailed response that addresses the question directly.
            </p>
          </li>
          <li>
            <p>
              Upvoting and Downvoting: Our platform allows users to upvote or
              downvote questions and answers based on their quality and
              relevance. Upvoting a question or answer increases its visibility
              on the platform, while downvoting decreases its visibility. This
              helps to ensure that the best questions and answers rise to the
              top.
            </p>
          </li>
          <li>
            <p>
              Searching for Answers: If you have a question but don't want to
              ask it yourself, you can use our search function to find relevant
              questions and answers. Simply enter a keyword or phrase related to
              your question, and our platform will provide a list of relevant
              questions and answers.
            </p>
          </li>
          <li>
            <p>
              Following Users and Topics: If you find a user or topic that
              you're interested in, you can follow them to receive notifications
              when new questions and answers are posted. This helps you stay
              up-to-date on the latest discussions in your area of interest.
            </p>
          </li>
        </ol>

        <p>
          We hope you find our platform helpful and easy to use. If you have any
          questions or feedback, please don't hesitate to contact our customer
          support team.
        </p>
      </div>
    </div>
    <script>
      // get all accordion headers and content
      const accordionHeaders = document.querySelectorAll(".accordion-header");
      const accordionContent = document.querySelectorAll(".accordion-content");

      // add click event listeners to accordion headers
      accordionHeaders.forEach((header) => {
        header.addEventListener("click", () => {
          // toggle the active class on the accordion toggle button
          header.querySelector(".accordion-toggle").classList.toggle("active");
          // toggle the active class on the accordion content
          header.nextElementSibling.classList.toggle("active");
        });
      });
    </script>
  </body>
</html>
