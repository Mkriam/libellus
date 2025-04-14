<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>readbooks</title>
  <style>
    /* Reinicio básico */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    
    body {
      font-family: Arial, sans-serif;
      line-height: 1.6;
      background-color: #f9f9f9;
      color: #333;
    }
    
    /* Header */
    header {
      background-color: #f5f5f5;
      border-bottom: 1px solid #ddd;
    }
    .top-bar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 10px 20px;
    }
    .logo {
      font-size: 1.8rem;
      font-weight: bold;
      color: #333;
    }
    .search-bar {
      flex-grow: 1;
      margin: 0 20px;
    }
    .search-bar input {
      width: 100%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 1rem;
    }
    .menu {
      font-size: 1.2rem;
      color: #333;
      cursor: pointer;
    }
    
    /* Main (contenido de ejemplo) */
    main {
      padding: 40px 20px;
      text-align: center;
    }
    
    /* Footer */
    footer {
      background-color: #333;
      color: #fff;
      padding: 20px;
    }
    .footer-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
    }
    .footer-section {
      flex: 1;
      padding: 10px;
      min-width: 200px;
    }
    .footer-section h3 {
      margin-bottom: 10px;
      font-size: 1.1rem;
    }
    .footer-section ul {
      list-style-type: none;
    }
    .footer-section ul li {
      margin-bottom: 5px;
    }
    .footer-section ul li a {
      color: #fff;
      text-decoration: none;
      transition: text-decoration 0.3s ease;
    }
    .footer-section ul li a:hover {
      text-decoration: underline;
    }
    .footer-bottom {
      text-align: center;
      margin-top: 20px;
      border-top: 1px solid #444;
      padding-top: 10px;
      font-size: 0.9rem;
    }
    
    /* Responsive tweaks */
    @media(max-width: 600px) {
      .top-bar {
        flex-direction: column;
        text-align: center;
      }
      .search-bar {
        margin: 10px 0;
      }
      .footer-container {
        flex-direction: column;
        align-items: center;
      }
      .footer-section {
        margin-bottom: 20px;
      }
    }
  </style>
</head>
<body>
  <!-- Header -->
  <header>
    <div class="top-bar">
      <div class="logo">readbooks</div>
      <div class="search-bar">
        <input type="text" placeholder="Search Book">
      </div>
      <div class="menu">Menu</div>
    </div>
  </header>
  
  <!-- Contenido Principal -->
  <main>
    <h1>Welcome to readbooks</h1>
    <p>Discover book reviews, recommendations and much more.</p>
  </main>
  
  <!-- Footer -->
  <footer>
    <div class="footer-container">
      <!-- Sección de enlaces -->
      <div class="footer-section">
        <h3>Links</h3>
        <ul>
          <li><a href="#">Home</a></li>
          <li><a href="#">Categories</a></li>
          <li><a href="#">About Us</a></li>
        </ul>
      </div>
      <!-- Sección de redes sociales -->
      <div class="footer-section">
        <h3>Social Media</h3>
        <ul>
          <li><a href="#">Facebook</a></li>
          <li><a href="#">Twitter</a></li>
          <li><a href="#">Instagram</a></li>
        </ul>
      </div>
      <!-- Sección de contacto -->
      <div class="footer-section">
        <h3>Contact</h3>
        <p>Email: info@readbooks.com</p>
        <p>Tel: +123-456-7890</p>
      </div>
    </div>
    <div class="footer-bottom">
      &copy; 2025 readbooks. All rights reserved.
    </div>
  </footer>
</body>
</html>
