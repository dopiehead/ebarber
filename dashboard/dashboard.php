<?php include("checkSession.php")  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Overview</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/dashboard/dashboard.css">
    <link rel="stylesheet" href="../assets/css/dashboard/sidebar.css">
    <link rel="stylesheet" href="../assets/css/dashboard/overview.css">
    <link rel="stylesheet" href="../assets/css/dashboard/settings.css">
</head>
<body>
    <!-- Sidebar -->
   <?php include ("components/sidebar.php"); ?>
    <!-- Main Content -->
    <div class="main-content bg-secondary">
        <!-- Header -->
       <?php include("components/overview.php"); ?>

        <!-- Navigation Tabs -->
        <div class="tabs-nav">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="#overview">Overview</a>
                </li>

            </ul>
        </div>

        <!-- Dashboard Content -->
        <div class="dashboard-content">
            <!-- Stats Cards -->
            <div class="stats-cards">
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon customers">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-menu">
                            <i class="fas fa-ellipsis-v"></i>
                        </div>
                    </div>
                    <div class="stat-value">0</div>
                    <div class="stat-label">Total Customers</div>
                    <div class="stat-change positive">
                        <i class="fas fa-arrow-up"></i>
                        <span>18% vs last month</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon members">
                            <i class="fas fa-user-friends"></i>
                        </div>
                        <div class="stat-menu">
                            <i class="fas fa-ellipsis-v"></i>
                        </div>
                    </div>
                    <div class="stat-value">0</div>
                    <div class="stat-label">Monthly income</div>
                    <div class="stat-change negative">
                        <i class="fas fa-arrow-down"></i>
                        <span>88% vs last month</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon users">
                            <i class="fas fa-eye"></i>
                        </div>
                        <div class="stat-menu">
                            <i class="fas fa-ellipsis-v"></i>
                        </div>
                    </div>
                    <div class="stat-value">0</div>
                    <div class="stat-label">Requests</div>
                    <div class="user-avatars">
                        <div class="user-avatar" style="background: linear-gradient(45deg, #ff6b6b, #ee5a6f);"></div>
                        <div class="user-avatar" style="background: linear-gradient(45deg, #4ecdc4, #44a08d);"></div>
                        <div class="user-avatar" style="background: linear-gradient(45deg, #45b7d1, #96c93d);"></div>
                        <div class="user-avatar" style="background: linear-gradient(45deg, #f093fb, #f5576c);"></div>
                        <div class="user-avatar" style="background: linear-gradient(45deg, #4facfe, #00f2fe);"></div>
                    </div>
                </div>
            </div>

            <!-- Activity Section -->
            <div class="activity-section">
                <div class="activity-header">
                    <div>
                        <h3 class="activity-title">
                            Vendor Activity History
                            <span class="activity-total">116 Total</span>
                        </h3>
                        <p class="activity-subtitle">Here you can track your vendor's performance everyday</p>
                    </div>
                    <div class="activity-controls">
                        <div class="search-box">
                            <i class="fas fa-search"></i>
                            <input type="text" placeholder="Search Order" id="searchInput">
                        </div>
                        <div class="filter-dropdown">
                            <button class="dropdown-btn" onclick="toggleDropdown('statusFilter')">
                                <i class="fas fa-dollar-sign"></i>
                                <span>Paid</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                        </div>
                        <div class="filter-dropdown">
                            <button class="dropdown-btn" onclick="toggleDropdown('categoryFilter')">
                                <i class="fas fa-tags"></i>
                                <span>All Category</span>
                                <i class="fas fa-chevron-down"></i>
                            </button>
                        </div>
                        <button class="clear-filter" onclick="clearFilters()">
                            Clear All <i class="fas fa-times"></i>
                        </button>
              
                        <button class="add-customer-btn" onclick="addCustomer()">
                            <i class="fas fa-plus"></i> Search for Customer
                        </button>
                    </div>
                </div>

                <div class="table-container">
                    <table class="activity-table">
                        <thead>
                            <tr>
                                <th>Company Name</th>
                                <th>Performance</th>
                                <th>Description</th>
                                <th>Last Checked</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr onclick="selectRow(this)">
                                <td>
                                    <div class="company-info">
                                        <div class="company-logo" style="background: #00b894;">
                                            <i class="fas fa-cube"></i>
                                        </div>
                                        <div class="company-details">
                                            <h6>Blox</h6>
                                            <p>getblox.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="progress-bar">
                                        <div class="progress-fill purple" style="width: 28%;"></div>
                                    </div>
                                    <div class="progress-percentage">28%</div>
                                </td>
                                <td>
                                    <div class="description">
                                        <h6>AI Content Creation App</h6>
                                        <p>Makes magic with the power of AI/ML</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="date">July 15, 2026</div>
                                </td>
                                <td>
                                    <span class="status-badge paid">Paid</span>
                                </td>
                                <td>
                                    <div class="row-menu">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </div>
                                </td>
                            </tr>
                            <tr onclick="selectRow(this)">
                                <td>
                                    <div class="company-info">
                                        <div class="company-logo" style="background: #e17055;">
                                            <i class="fas fa-layer-group"></i>
                                        </div>
                                        <div class="company-details">
                                            <h6>Brotha Platforms</h6>
                                            <p>brotha.gg</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="progress-bar">
                                        <div class="progress-fill pink" style="width: 12%;"></div>
                                    </div>
                                    <div class="progress-percentage">12%</div>
                                </td>
                                <td>
                                    <div class="description">
                                        <h6>AI Billing And Invoicing App</h6>
                                        <p>Makes invoice and billing with AI/ML</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="date">July 8, 2026</div>
                                </td>
                                <td>
                                    <span class="status-badge failed">Failed</span>
                                </td>
                                <td>
                                    <div class="row-menu">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </div>
                                </td>
                            </tr>
                            <tr onclick="selectRow(this)">
                                <td>
                                    <div class="company-info">
                                        <div class="company-logo" style="background: #6c5ce7;">
                                            <i class="fas fa-code"></i>
                                        </div>
                                        <div class="company-details">
                                            <h6>Layerz Softwares</h6>
                                            <p>layerz.io</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="progress-bar">
                                        <div class="progress-fill blue" style="width: 71%;"></div>
                                    </div>
                                    <div class="progress-percentage">71%</div>
                                </td>
                                <td>
                                    <div class="description">
                                        <h6>Data Aggregation App</h6>
                                        <p>Compile and manage data seamlessly</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="date">July 1, 2026</div>
                                </td>
                                <td>
                                    <span class="status-badge pending">Pending</span>
                                </td>
                                <td>
                                    <div class="row-menu">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </div>
                                </td>
                            </tr>
                            <tr onclick="selectRow(this)">
                                <td>
                                    <div class="company-info">
                                        <div class="company-logo" style="background: #74b9ff;">
                                            <i class="fas fa-share-alt"></i>
                                        </div>
                                        <div class="company-details">
                                            <h6>Linez Technologies</h6>
                                            <p>linez.tech</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="progress-bar">
                                        <div class="progress-fill purple" style="width: 20%;"></div>
                                    </div>
                                    <div class="progress-percentage">20%</div>
                                </td>
                                <td>
                                  