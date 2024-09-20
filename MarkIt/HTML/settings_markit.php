<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Settings | MarkIt</title>
  <link rel="stylesheet" href="../CSS/settingsstyle_markit.css" />
  <link href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
</head>
<body>
  <nav>
    <div class="markit-logo">
      <a href="#">MarkIT</a>
    </div>
    <div class="navs">
      <ul>
        <li><a href="index.php"><i class="fa-solid fa-house"></i></a></li>
        <li><a href="products_markit.php"><i class="fa-solid fa-box"></i></a></li>
        <li><a href="inventory_markit.php"><i class="fa-solid fa-warehouse"></i></a></li>
        <li><a href="transaction_markit.php"><i class="fa-solid fa-right-left"></i></a></li>
        <li><a href="profile_markit.php"><i class="fa-solid fa-user"></i></a></li>
        <li><a href="settings_markit.php"><i class="fa-solid fa-gear" style="color: #2C74B3;"></i></a></li>
      </ul>
    </div>
  </nav>
  <div class="container">
    <div class="sidebar-container">
      <div class="sidebar">
        <nav class="sidebar-menu">
          <div class="menu-bar">
            <div class="menu">
              <ul class="menu-links">
                <li class="nav-link about-markit">
                  <a href="#" id="aboutMarkitLink">
                    <i class="bx bx-home-alt icon"></i>
                    <span class="text nav-text">About Markit</span>
                  </a>
                </li>
                <li class="nav-link account-settings">
                  <a href="#" id="accountSettingsLink">
                    <i class="bx bx-bar-chart-alt-2 icon"></i>
                    <span class="text nav-text">Account Settings</span>
                  </a>
                </li>
                <li class="nav-link product-settings">
                  <a href="#">
                    <i class="bx bx-cog"></i>
                    <span class="text nav-text">Product Settings</span>
                  </a>
                </li>
                <li class="nav-link inventory-settings">
                  <a href="#">
                    <i class="bx bx-pie-chart-alt icon"></i>
                    <span class="text nav-text">Inventory Settings</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </div>
    </div>
    <div class="main-content">
      <div class="settings" id="settings">
      </div>
    </div>
  </div>

  <div class="wrapper-about">
    <div class="container-about">
      <h2>About MarkIt</h2>
      <div class="content">
        MarkIt, your partner in streamlining sales and inventory management processes with ease and efficiency. Tailored specifically for businesses, MarkIt offers a cashier-like experience, simplifying the recording of sales and eliminating the hassle of manual computations. Configurable settings enable you to tailor MarkIt to your specific requirements, making it an invaluable tool for corporate administration. Whether you're a startup looking to streamline operations or an established enterprise seeking to stay ahead in a competitive market, MarkIt is here to simplify processes, boost efficiency, and drive growth for your business.
      </div>
      <h2 class="dev">Developers</h2>
      <div class="images">
        <div class="circle">
          <img class="images" src="../Images/Jm-Araneta.jpg" alt="Image 1" />
          <div class="name">John Manuel N. Araneta</div>
        </div>
        <div class="circle">
          <img src="../Images/Larsen-Atienza.jpg" alt="Image 2" />
          <div class="name">Larsen V. Atienza</div>
        </div>
        <div class="circle">
          <img src="../Images/Joshua-Javier.jpg" alt="Image 3" />
          <div class="name">Joshua R. Javier</div>
        </div>
        <div class="circle">
          <img src="../Images/JL-Landicho.jpg" alt="Image 4" />
          <div class="name">Jhon Lloyd G. Landicho</div>
        </div>
      </div>
    </div>
  </div>

  <div class="wrapper-account">
    <h2>Account Settings</h2>
    <div class="container-account">
      <div class="form-content">
        <div class="form-group">
          <label for="username">Username:</label>
          <input class="inputf" type="text" id="username" name="username" readonly placeholder="Enter Username" value="JohnDoe" />
          <button class="edit-button" onclick="toggleEdit('username')">Edit</button>
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input class="inputf" type="email" id="email" name="email" readonly placeholder="Enter Email" value="example@example.com" />
          <button class="edit-button" onclick="toggleEdit('email')">Edit</button>
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input class="inputf" type="password" id="password" name="password" readonly placeholder="Enter Password" value="securePassword" />
          <button class="edit-button" onclick="toggleEdit('password')">Edit</button>
        </div>
      </div>
    </div>
  </div>

  <div class="wrapper-product">
    <h2>Transaction Table</h2>
    <table>
      <thead>
        <tr>
          <th>Transaction ID</th>
          <th>Date</th>
          <th>Time</th>
          <th>Total Price</th>
          <th>Items</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>TXN001</td>
          <td>2024-05-01</td>
          <td>10:15 AM</td>
          <td>$120.50</td>
          <td>Item1, Item2, Item3</td>
        </tr>
        <tr>
          <td>TXN002</td>
          <td>2024-05-02</td>
          <td>11:30 AM</td>
          <td>$80.75</td>
          <td>Item4, Item5</td>
        </tr>
        <tr>
          <td>TXN003</td>
          <td>2024-05-03</td>
          <td>02:45 PM</td>
          <td>$50.00</td>
          <td>Item6, Item7, Item8</td>
        </tr>
        <tr>
          <td>TXN004</td>
          <td>2024-05-04</td>
          <td>09:20 AM</td>
          <td>$200.00</td>
          <td>Item9, Item10</td>
        </tr>
        <tr>
          <td>TXN005</td>
          <td>2024-05-05</td>
          <td>03:50 PM</td>
          <td>$150.25</td>
          <td>Item11, Item12, Item13</td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="wrapper-inventory">
    <h2>Transaction Table</h2>
    <div class="content">
      <table>
        <thead>
          <tr>
            <th>Transaction ID</th>
            <th>Date</th>
            <th>Time</th>
            <th>Total Price</th>
            <th>Items</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>TXN001</td>
            <td>2024-05-01</td>
            <td>10:15 AM</td>
            <td>$120.50</td>
            <td>Item1, Item2, Item3</td>
          </tr>
          <tr>
            <td>TXN002</td>
            <td>2024-05-02</td>
            <td>11:30 AM</td>
            <td>$80.75</td>
            <td>Item4, Item5</td>
          </tr>
          <tr>
            <td>TXN003</td>
            <td>2024-05-03</td>
            <td>02:45 PM</td>
            <td>$50.00</td>
            <td>Item6, Item7, Item8</td>
          </tr>
          <tr>
            <td>TXN004</td>
            <td>2024-05-04</td>
            <td>09:20 AM</td>
            <td>$200.00</td>
            <td>Item9, Item10</td>
          </tr>
          <tr>
            <td>TXN005</td>
            <td>2024-05-05</td>
            <td>01:50 PM</td>
            <td>$50.15</td>
            <td>Item3, Item7</td>
          </tr>
          <tr>
            <td>TXN006</td>
            <td>2024-05-06</td>
            <td>11:20 PM</td>
            <td>$150.25</td>
            <td>Item16, Item5, Item17</td>
          </tr>
          <tr>
            <td>TXN007</td>
            <td>2024-05-07</td>
            <td>06:04 PM</td>
            <td>$10.50</td>
            <td>Item1, Item4</td>
          </tr>
          <tr>
            <td>TXN008</td>
            <td>2024-05-07</td>
            <td>09:52 PM</td>
            <td>$87.12</td>
            <td>Item4, Item9, Item6</td>
          </tr>
          <tr>
            <td>TXN009</td>
            <td>2024-05-08</td>
            <td>07:25 AM</td>
            <td>$181.26</td>
            <td>Item2, Item14, Item12</td>
          </tr>
        </tbody>
      </table>
    </div>
    
  <script>
 document.querySelector('.about-markit a').addEventListener('click', function() {
  document.querySelector('.wrapper-about').style.display = 'block';
  document.querySelector('.wrapper-account').style.display = 'none';
  document.querySelector('.wrapper-product').style.display = 'none';
  document.querySelector('.wrapper-inventory').style.display = 'none';

  setActiveLink(this);
});

document.querySelector('.account-settings a').addEventListener('click', function() {
  document.querySelector('.wrapper-about').style.display = 'none';
  document.querySelector('.wrapper-account').style.display = 'block';
  document.querySelector('.wrapper-product').style.display = 'none';
  document.querySelector('.wrapper-inventory').style.display = 'none';

  setActiveLink(this);
});

document.querySelector('.product-settings a').addEventListener('click', function() {
  document.querySelector('.wrapper-about').style.display = 'none';
  document.querySelector('.wrapper-account').style.display = 'none';
  document.querySelector('.wrapper-product').style.display = 'block';
  document.querySelector('.wrapper-inventory').style.display = 'none';

  setActiveLink(this);
});

document.querySelector('.inventory-settings a').addEventListener('click', function() {
  document.querySelector('.wrapper-about').style.display = 'none';
  document.querySelector('.wrapper-account').style.display = 'none';
  document.querySelector('.wrapper-product').style.display = 'none';
  document.querySelector('.wrapper-inventory').style.display = 'block';

  setActiveLink(this);
});

function setActiveLink(activeLink) {
  document.querySelectorAll('.menu-links a').forEach(link => {
    link.style.backgroundColor = '';
  });
  activeLink.style.backgroundColor = '#bbb';
}

function toggleEdit(inputId) {
  const input = document.getElementById(inputId);
  const button = input.nextElementSibling;

  if (input.readOnly) {
    input.readOnly = false;
    button.textContent = "Save";
    input.focus();
  } else {
    input.readOnly = true;
    button.textContent = "Edit";
  }
}
  </script>
  </body>
</html>
