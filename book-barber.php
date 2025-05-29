<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php include("components/links.php"); ?>
    <title>Book barber</title>
</head>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile UI</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #1a1a1a;
            color: #fff;
            padding-bottom: 40px;
        }

        /* Navigation bar styles */
        .navbar {
            background-color: #1a1a1a;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            border-bottom: 1px solid #333;
        }

        .menu-icon {
            color: #f0c14b;
            font-size: 24px;
            cursor: pointer;
        }

        .nav-links {
            display: flex;
            flex-grow: 1;
            justify-content: center;
            gap: 25px;
        }

        .nav-links a {
            color: #fff;
            text-decoration: none;
            font-size: 14px;
        }

        .nav-links a.active {
            color: #fff;
            font-weight: bold;
        }

        .book-btn {
            background-color: transparent;
            color: #fff;
            border: 1px solid #f0c14b;
            padding: 8px 20px;
            cursor: pointer;
            font-size: 12px;
            text-transform: uppercase;
            font-weight: bold;
        }

        /* Profile Section styles */
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px 0;
        }

        .section-title {
            margin: 20px 0;
            font-size: 16px;
            color: #777;
            text-transform: uppercase;
        }

        /* Profile Photo section */
        .profile-section {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 30px;
        }

        .profile-photo-container {
            background-color: #fff;
            padding: 20px;
            width: 200px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .profile-photo-title {
            color: #000;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .profile-photo {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: linear-gradient(to right, #ff3366, #ff00cc);
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .profile-img {
            width: 90%;
            height: 90%;
            border-radius: 50%;
            object-fit: cover;
        }

        .camera-icon {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background-color: #fff;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .camera-icon span {
            color: #777;
            font-size: 12px;
        }

        /* Form section */
        .form-container {
            flex: 1;
            min-width: 300px;
            background-color: #222;
            border-radius: 5px;
            padding: 20px;
        }

        .form-row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 15px;
        }

        .form-group {
            flex: 1;
            min-width: 200px;
        }

        .form-label {
            display: block;
            font-size: 10px;
            color: #777;
            margin-bottom: 5px;
            text-transform: uppercase;
        }

        .form-control {
            width: 100%;
            background-color: transparent;
            border: 1px solid #444;
            padding: 8px 12px;
            color: #fff;
            border-radius: 3px;
        }

        .form-select {
            appearance: none;
            background-image: url("data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%23FFFFFF%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E");
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 12px;
        }

        /* Address section */
        .address-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 30px;
        }

        .address-box {
            flex: 1;
            min-width: 250px;
            background-color: #222;
            border-radius: 5px;
            padding: 15px;
            border: 1px solid #444;
            font-size: 14px;
            line-height: 1.4;
        }

        /* Education section */
        .education-section {
            margin-bottom: 30px;
        }

        .education-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .add-btn {
            background-color: transparent;
            border: 1px solid #444;
            color: #fff;
            padding: 4px 10px;
            border-radius: 3px;
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 12px;
        }

        .education-form {
            background-color: #222;
            border-radius: 5px;
            padding: 20px;
        }

        .date-section {
            display: flex;
            gap: 15px;
            align-items: flex-end;
            margin-bottom: 20px;
        }

        .date-group {
            flex: 1;
            max-width: 150px;
        }

        .present-group {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 12px;
            margin-left: 20px;
        }

        .checkbox-container {
            position: relative;
            cursor: pointer;
            display: flex;
            align-items: center;
        }

        .custom-checkbox {
            width: 16px;
            height: 16px;
            border: 1px solid #444;
            border-radius: 3px;
            display: inline-block;
            margin-right: 8px;
        }

        .submit-section {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
        }

        .submit-btn {
            background-color: #f0c14b;
            color: #000;
            border: none;
            padding: 8px 25px;
            border-radius: 50px;
            font-weight: bold;
            cursor: pointer;
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }
            
            .profile-section, 
            .address-container {
                flex-direction: column;
            }
            
            .profile-photo-container {
                width: 100%;
                max-width: 250px;
                margin: 0 auto;
            }
            
            .form-row {
                flex-direction: column;
                gap: 15px;
            }
            
            .form-group {
                width: 100%;
            }
            
            .date-section {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .date-group {
                max-width: 100%;
                width: 100%;
            }
            
            .present-group {
                margin-left: 0;
                margin-top: 10px;
            }
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #1a1a1a;
            color: #fff;
            padding: 20px;
        }

        /* Header section styles */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 18px;
            font-weight: normal;
        }

        .add-btn {
            background-color: #f5f5f5;
            color: #333;
            border: none;
            border-radius: 20px;
            padding: 5px 15px;
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 12px;
            cursor: pointer;
        }

        .add-btn .plus {
            font-weight: bold;
        }

        /* Work experience form styles */
        .experience-form {
            background-color: #222;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .form-row {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 15px;
        }

        .form-group {
            flex: 1;
            min-width: 200px;
        }

        .form-label {
            display: block;
            font-size: 10px;
            color: #777;
            margin-bottom: 5px;
            text-transform: uppercase;
        }

        .form-control {
            width: 100%;
            background-color: transparent;
            border: 1px solid #444;
            padding: 8px 12px;
            color: #fff;
            border-radius: 3px;
            font-size: 14px;
        }

        .form-select {
            appearance: none;
            background-image: url("data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%23FFFFFF%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E");
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 12px;
        }

        .year-picker {
            width: 120px;
        }

        /* Checkbox styles */
        .checkbox-group {
            display: flex;
            align-items: center;
            margin-top: 5px;
            margin-bottom: 15px;
        }

        .checkbox-container {
            position: relative;
            cursor: pointer;
            display: flex;
            align-items: center;
        }

        .custom-checkbox {
            width: 16px;
            height: 16px;
            border: 1px solid #444;
            border-radius: 3px;
            display: inline-block;
            margin-right: 8px;
            background-color: #222;
        }

        .checkbox-label {
            font-size: 12px;
            color: #ccc;
        }

        /* Address display styles */
        .address-box {
            background-color: transparent;
            padding: 15px 0;
            font-size: 13px;
            line-height: 1.4;
            color: #ccc;
        }

        /* Action buttons styles */
        .action-buttons {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        .action-button {
            padding: 6px 15px;
            border-radius: 20px;
            border: none;
            font-size: 12px;
            cursor: pointer;
        }

        .delete-btn {
            background-color: #fff;
            color: #333;
            flex: 0 0 100px;
        }

        .edit-btn {
            background-color: #666;
            color: #fff;
            flex: 0 0 60px;
        }

        .save-btn {
            background-color: #fff;
            color: #333;
            flex: 0 0 60px;
            margin-left: auto;
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .form-row {
                flex-direction: column;
                gap: 10px;
            }
            
            .action-buttons {
                flex-wrap: wrap;
            }
            
            .action-button {
                flex: 1;
                min-width: 80px;
                text-align: center;
            }
        }
               /* Global Styles */
               * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        /* Container Styles */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #121212;
            color: #fff;
        }

        /* Section Header Styles */
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .section-title {
            font-size: 18px;
            font-weight: 500;
        }

        .add-btn {
            background-color: #1e1e1e;
            border: 1px solid #333;
            color: #fff;
            border-radius: 4px;
            padding: 4px 10px;
            cursor: pointer;
            display: flex;
            align-items: center;
            font-size: 14px;
        }

        .add-btn::before {
            content: "+";
            margin-right: 5px;
        }

        /* Certificate Section Styles */
        .certificate-section {
            background-color: #121212;
            margin-bottom: 25px;
        }

        .certificate-form {
            border: 1px solid #2c8562;
            border-radius: 8px;
            padding: 20px;
            background-color: rgba(44, 133, 98, 0.1);
        }

        /* Form Field Styles */
        .form-field {
            margin-bottom: 15px;
        }

        .form-label {
            display: block;
            color: #888;
            margin-bottom: 5px;
            font-size: 14px;
        }

        .form-input {
            width: 100%;
            padding: 10px;
            background-color: #1e1e1e;
            border: 1px solid #333;
            border-radius: 4px;
            color: #fff;
        }

        /* Guarantors Section Styles */
        .guarantors-section {
            background-color: #121212;
        }

        .guarantors-container {
            display: grid;
            grid-template-columns: 1fr;
            gap: 15px;
        }

        @media (min-width: 768px) {
            .guarantors-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .guarantor-card {
            background-color: #1e1e1e;
            border-radius: 8px;
            padding: 15px;
        }

        /* Button Styles */
        .action-buttons {
            display: flex;
            justify-content: flex-end;
            margin-top: 15px;
        }

        .edit-btn {
            background-color: transparent;
            border: none;
            color: #888;
            cursor: pointer;
            display: flex;
            align-items: center;
            font-size: 14px;
        }

        .edit-btn::before {
            content: "✎";
            margin-right: 5px;
        }

        .submit-btn {
            background-color: #fff;
            color: #000;
            border: none;
            border-radius: 4px;
            padding: 8px 16px;
            font-weight: 500;
            cursor: pointer;
        }
        /* Reset Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }
        
        /* Container Styles */
        .container {
            background-color: #1a1a1a;
            color: #fff;
            padding: 20px;
            max-width: 100%;
            overflow-x: auto;
        }
        
        /* Header Navigation Styles */
        .header-nav {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            align-items: center;
        }
        
        .nav-tabs {
            display: flex;
            gap: 20px;
        }
        
        .nav-tab {
            color: #999;
            font-size: 14px;
            cursor: pointer;
        }
        
        .nav-tab.active {
            color: #fff;
            position: relative;
        }
        
        .nav-tab.active::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: #fff;
        }
        
        .period-selector {
            background-color: #333;
            border: none;
            border-radius: 4px;
            color: #fff;
            padding: 6px 12px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
        }
        
        .period-selector::before {
            content: '📅';
        }
        
        /* Table Styles */
        .records-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .records-table th {
            text-align: left;
            padding: 10px 15px;
            color: #999;
            font-weight: normal;
            font-size: 14px;
        }
        
        .records-table td {
            padding: 12px 15px;
            font-size: 14px;
            border-bottom: 1px solid #333;
        }
        
        .records-table tr:last-child td {
            border-bottom: none;
        }
        
        /* Month Header Styles */
        .month-header {
            background-color: #262626;
            border-radius: 15px;
            padding: 5px 15px;
            display: inline-block;
            margin: 10px 0;
            font-size: 14px;
        }
        
        /* Row Checkbox Styles */
        .checkbox-cell {
            width: 40px;
            text-align: center;
        }
        
        .row-checkbox {
            appearance: none;
            -webkit-appearance: none;
            background-color: transparent;
            border: 1px solid #555;
            width: 16px;
            height: 16px;
            border-radius: 3px;
            cursor: pointer;
            position: relative;
        }
        
        .row-checkbox:checked {
            background-color: #555;
        }
        
        .row-checkbox:checked::after {
            content: '✓';
            font-size: 12px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #fff;
        }
        
        /* Highlighted Row Styles */
        .highlighted-row td {
            background-color: rgba(66, 133, 244, 0.1);
        }
        
        .highlighted-row .address-cell {
            color: #4285f4;
        }
        
        /* See More Button Styles */
        .see-more-container {
            text-align: center;
            margin-top: 15px;
        }
        
        .see-more-btn {
            background-color: #333;
            border: none;
            color: #fff;
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 14px;
            cursor: pointer;
        }
        
        /* Mobile Responsive Styles */
        @media (max-width: 768px) {
            .records-table th:nth-child(3),
            .records-table td:nth-child(3) {
                display: none;
            }
            
            .records-table th,
            .records-table td {
                padding: 10px 8px;
            }
        }
        
        @media (max-width: 480px) {
            .nav-tabs {
                gap: 10px;
            }
            
            .records-table th:nth-child(4),
            .records-table td:nth-child(4) {
                display: none;
            }
        }
    </style>

</head>
<body>
    <!-- Navigation Bar Section -->
    <nav class="navbar">
        <div class="menu-icon">☰</div>
        <div class="nav-links">
            <a href="#" class="active">Home</a>
            <a href="#">Services</a>
            <a href="#">About Us</a>
            <a href="#">e-stylist</a>
            <a href="#">Blog</a>
            <a href="#">Contact Us</a>
        </div>
        <button class="book-btn">BOOK APPOINTMENT</button>
    </nav>

    <div class="container">
        <!-- Profile Section -->
        <h2 class="section-title">Profile</h2>
        
        <div class="profile-section">
            <!-- Profile Photo Container -->
            <div class="profile-photo-container">
                <div class="profile-photo-title">Profile Photo</div>
                <div class="profile-photo">
                    <img src="https://images.unsplash.com/photo-1531123897727-8f129e1688ce?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Profile" class="profile-img">
                    <div class="camera-icon">
                        <span>📷</span>
                    </div>
                </div>
            </div>

            <!-- Personal Information Form -->
            <div class="form-container">
                <form>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">First Name</label>
                            <input type="text" class="form-control" value="James">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Last Name</label>
                            <input type="text" class="form-control" value="Johnson">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" value="james@example.com">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" value="08123456789">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Age</label>
                            <input type="number" class="form-control" value="18">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Race</label>
                            <select class="form-control form-select">
                                <option>Black</option>
                                <option>White</option>
                                <option>Asian</option>
                                <option>Hispanic</option>
                                <option>Other</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Gender</label>
                            <select class="form-control form-select">
                                <option>Male</option>
                                <option>Female</option>
                                <option>Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Disability</label>
                            <select class="form-control form-select">
                                <option>None</option>
                                <option>Physical</option>
                                <option>Visual</option>
                                <option>Hearing</option>
                                <option>Other</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Address Section -->
        <div class="address-container px-4">
            <div class="address-box">
                15, Iyala street Akindeibun, off Shoprite, Akasia, Ikeja Lagos state Nigeria
            </div>
            <div class="address-box">
                15, Iyala street Akindeibun, off Shoprite, Akasia, Ikeja Lagos state Nigeria
            </div>
        </div>

        <!-- Education Section -->
        <div class="education-section px-4">
            <div class="education-header">
                <h2 class="section-title">Education</h2>
                <button class="add-btn">
                    <span>+</span> Add
                </button>
            </div>

            <div class="education-form">
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">School Name</label>
                        <input type="text" class="form-control" value="James">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Degree</label>
                        <input type="text" class="form-control" value="James">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Subject</label>
                        <input type="text" class="form-control" value="James">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Location</label>
                        <input type="text" class="form-control" value="James">
                    </div>
                </div>

                <div class="form-group" style="margin-bottom: 20px;">
                    <label class="form-label">Activities</label>
                    <input type="text" class="form-control" value="James">
                </div>

                <div class="date-section">
                    <div class="date-group">
                        <label class="form-label">Start year</label>
                        <select class="form-control form-select">
                            <option>1999</option>
                            <option>2000</option>
                            <option>2001</option>
                        </select>
                    </div>
                    <div class="date-group">
                        <label class="form-label">Finish year</label>
                        <select class="form-control form-select">
                            <option>2003</option>
                            <option>2004</option>
                            <option>2005</option>
                        </select>
                    </div>
                    <div class="present-group">
                        <div class="checkbox-container">
                            <span class="custom-checkbox"></span>
                            I am still schooling here
                        </div>
                    </div>
                </div>

                <div class="submit-section">
                    <button type="submit" class="submit-btn">Save</button>
                </div>
            </div>
        </div>
  

    <!-- Header Section -->
    <div class="header">
        <h1 class="text-uppercase">Work Experience</h1>
        <button class="add-btn">
            <span class="plus">+</span> Add
        </button>
    </div>

    <!-- First Work Experience Form -->
    <div class="experience-form px-4">
        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Company</label>
                <input type="text" class="form-control" value="James">
            </div>
            <div class="form-group">
                <label class="form-label">Position</label>
                <input type="text" class="form-control" value="James">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Start year</label>
                <select class="form-control form-select year-picker">
                    <option>1999</option>
                    <option>2000</option>
                    <option>2001</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Finish year</label>
                <select class="form-control form-select year-picker">
                    <option>1999</option>
                    <option>2000</option>
                    <option>2001</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Country</label>
                <input type="text" class="form-control" value="James">
            </div>
        </div>

        <div class="checkbox-group">
            <div class="checkbox-container">
                <span class="custom-checkbox"></span>
                <span class="checkbox-label">I am still working here</span>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Salary</label>
            <input type="text" class="form-control" placeholder="1000000 NGN">
        </div>

        <div class="address-box">
            15, Iyala street Akindeibun, off Shoprite, Akusia, Ikeja Lagos state Nigeria off Shoprite, Akusia, Ikeja Lagos state Nigeria
        </div>

        <div class="action-buttons">
            <button class="action-button delete-btn">Delete</button>
            <button class="action-button edit-btn">Edit</button>
            <button class="action-button save-btn">Save</button>
        </div>
    </div>

    <!-- Second Work Experience Form -->
    <div class="experience-form">
        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Company</label>
                <input type="text" class="form-control" value="James">
            </div>
            <div class="form-group">
                <label class="form-label">Position</label>
                <input type="text" class="form-control" value="James">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Start year</label>
                <select class="form-control form-select year-picker">
                    <option>1999</option>
                    <option>2000</option>
                    <option>2001</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Finish year</label>
                <select class="form-control form-select year-picker">
                    <option>1999</option>
                    <option>2000</option>
                    <option>2001</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Country</label>
                <input type="text" class="form-control" value="James">
            </div>
        </div>

        <div class="checkbox-group">
            <div class="checkbox-container">
                <span class="custom-checkbox"></span>
                <span class="checkbox-label">I am still working here</span>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Salary</label>
            <input type="text" class="form-control" placeholder="1000000 NGN">
        </div>

        <div class="address-box">
            15, Iyala street Akindeibun, off Shoprite, Akusia, Ikeja Lagos state Nigeria off Shoprite, Akusia, Ikeja Lagos state Nigeria
        </div>

        <div class="action-buttons">
            <button class="action-button delete-btn">Delete</button>
            <button class="action-button edit-btn">Edit</button>
            <button class="action-button save-btn">Save</button>
        </div>
    </div>

    <div>
        <!-- Certificates Section -->
        <section class="certificate-section">
            <div class="section-header">
                <h2 class="section-title">Certificates</h2>
                <button class="add-btn">Add</button>
            </div>
            <div class="certificate-form">
                <div class="form-field">
                    <label class="form-label">Certificate</label>
                    <input type="text" class="form-input" placeholder="Certificate of Completion of Successful Training 22">
                </div>
                <div class="form-field">
                    <label class="form-label">Holder</label>
                    <input type="text" class="form-input" placeholder="John G Ngutu">
                </div>
                <div class="form-field">
                    <label class="form-label">Serial Number</label>
                    <input type="text" class="form-input" placeholder="1234">
                </div>
                <div class="action-buttons">
                    <button class="submit-btn">Add</button>
                </div>
            </div>
        </section>

        <!-- Guarantors Section -->
        <section class="guarantors-section">
            <div class="section-header">
                <h2 class="section-title">Guarantors</h2>
                <button class="add-btn">Add</button>
            </div>
            <div class="guarantors-container">
                <!-- Guarantor 1 -->
                <div class="guarantor-card">
                    <div class="form-field">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-input" placeholder="Mary Jones">
                    </div>
                    <div class="form-field">
                        <label class="form-label">ID Number</label>
                        <input type="text" class="form-input" placeholder="0981628470">
                    </div>
                    <div class="action-buttons">
                        <button class="edit-btn">Edit</button>
                    </div>
                </div>
                
                <!-- Guarantor 2 -->
                <div class="guarantor-card">
                    <div class="form-field">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-input" placeholder="Gary Jones">
                    </div>
                    <div class="form-field">
                        <label class="form-label">ID Number</label>
                        <input type="text" class="form-input" placeholder="2858028783">
                    </div>
                    <div class="action-buttons">
                        <button class="edit-btn">Edit</button>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="container">
        <!-- Header Navigation Section -->
        <div class="header-nav">
            <div class="nav-tabs">
                <div class="nav-tab active">Comment</div>
                <div class="nav-tab">History log</div>
            </div>
            <button class="period-selector">Monthly</button>
        </div>
        
        <!-- Table Section -->
        <table class="records-table">
            <thead>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Date</th>
                    <th>Change</th>
                </tr>
            </thead>
            <tbody>
                <!-- May Group -->
                <tr>
                    <td colspan="5"><div class="month-header">May</div></td>
                </tr>
                <tr>
                    <td class="checkbox-cell"><input type="checkbox" class="row-checkbox"></td>
                    <td>Mary Jane</td>
                    <td>1B, Iyalla street, Alausa Ikeja</td>
                    <td>03-may-2023</td>
                    <td>#46512</td>
                </tr>
                <tr>
                    <td class="checkbox-cell"><input type="checkbox" class="row-checkbox"></td>
                    <td>Mary Jane</td>
                    <td>1B, Iyalla street, Alausa Ikeja</td>
                    <td>03-may-2023</td>
                    <td>#46512</td>
                </tr>
                <tr>
                    <td class="checkbox-cell"><input type="checkbox" class="row-checkbox"></td>
                    <td>Mary Jane</td>
                    <td>1B, Iyalla street, Alausa Ikeja</td>
                    <td>03-may-2023</td>
                    <td>#46512</td>
                </tr>
                <tr>
                    <td class="checkbox-cell"><input type="checkbox" class="row-checkbox"></td>
                    <td>Mary Jane</td>
                    <td>1B, Iyalla street, Alausa Ikeja</td>
                    <td>03-may-2023</td>
                    <td>#46512</td>
                </tr>
                
                <!-- April Group -->
                <tr>
                    <td colspan="5"><div class="month-header">April</div></td>
                </tr>
                <tr>
                    <td class="checkbox-cell"><input type="checkbox" class="row-checkbox"></td>
                    <td>Mary Jane</td>
                    <td>1B, Iyalla street, Alausa Ikeja</td>
                    <td>03-may-2023</td>
                    <td>#46512</td>
                </tr>
                <tr class="highlighted-row">
                    <td class="checkbox-cell"><input type="checkbox" class="row-checkbox"></td>
                    <td>Mary Jane</td>
                    <td class="address-cell">1B, Iyalla street, Alausa Ikeja</td>
                    <td>03-may-2023</td>
                    <td>#46512</td>
                </tr>
                <tr>
                    <td class="checkbox-cell"><input type="checkbox" class="row-checkbox"></td>
                    <td>Mary Jane</td>
                    <td>1B, Iyalla street, Alausa Ikeja</td>
                    <td>03-may-2023</td>
                    <td>#46512</td>
                </tr>
                <tr>
                    <td class="checkbox-cell"><input type="checkbox" class="row-checkbox"></td>
                    <td>Mary Jane</td>
                    <td>1B, Iyalla street, Alausa Ikeja</td>
                    <td>03-may-2023</td>
                    <td>#46512</td>
                </tr>
            </tbody>
        </table>
        
        <!-- See More Button Section -->
        <div class="see-more-container">
            <button class="see-more-btn">See more</button>
        </div>
    </div>

 </div>
</body>
</html>