<?php
include 'config.php';
// Fetch participants from the database
$participantsQuery = "SELECT * FROM Participants";
$participantsResult = $conn->query($participantsQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participants - Sports Event Management System</title>
    <link rel="stylesheet" type="text/css" href="participantstyle.css">
</head>
<body>
<header>
        <h1>Sports Event Management System</h1>
    </header>

    <nav>
        <a href="admin.php">Home</a>
        <a href="events.php">Events</a>
        <a href="createevent.php">create Events</a>
        <a href="sports.php">Add sports</a>
        <a href="venue.php">Add venue</a>
        <a href="messages.php">Messages</a>
        <a href="participants.php">Participants</a>
        <a href="login.php?logout=true">Logout</a>
    </nav>

    <main>
        <h2>Participants</h2>

        <?php
        // Display participants in a table
        if ($participantsResult->num_rows > 0) {
            echo '<table>';
            echo '<tr><th>Full Name</th><th>Email</th><th>Gender</th><th>Event_id</th></tr>';
            while ($participant = $participantsResult->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $participant['FullName'] . '</td>';
                echo '<td>' . $participant['email'] . '</td>';
                echo '<td>' . $participant['Gender'] . '</td>';
                echo '<td>' . $participant['event_id'] . '</td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo '<p class="message">No participants found.</p>';
        }

        $conn->close();
        ?>
    </main>
</body>
</html>


insert

INSERT INTO customer (
    customer_id,
    address_line1,
    annual_income,
    card_type,
    city,
    company_name,
    country,
    date_of_birth,
    email,
    first_name,
    last_name,
    middle_name,
    phone,
    pincode,
    state
) VALUES (
    DEFAULT,
    '45 Nehru Street',
    '1200000',
    'VISA',
    'Mumbai',
    'Tata Consultancy Services',
    'India',
    '1988-11-23',
    'priya.singh@example.com',
    'Priya',
    'Singh',
    'L',
    '+919812345678',
    '400001',
    'Maharashtra'
);



.css
/* Wrapper Section */
.premium-card-section {
  width: 85%;
  padding: 10px;
  margin-left: 10px;
  border-radius: 16px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.25);
}

/* Header */
.premium-card-header h5 {
  color: #0473EA;
  font-size: 22px;
  font-weight: 600;
  padding-bottom: 12px;
  margin: 15px 0 20px;
  border-bottom: 2px solid #0473EA;
}

/* Main Layout */
.premium-layout {
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 28px;
}

/* Left: Credit Card UI */
.premium-card-visual {
  flex: 0.9;
}

.credit-card-ui {
  background: linear-gradient(135deg, #2b5876, #4e4376);
  width: 330px;
  height: 180px;
  padding: 20px;
  border-radius: 16px;
  color: #fff;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
}

.chip {
  width: 42px;
  height: 28px;
  background: gold;
  border-radius: 6px;
}

.cc-number {
  font-size: 18px;
  text-align: center;
  letter-spacing: 3px;
  font-weight: 600;
}

.cc-footer {
  display: flex;
  justify-content: space-between;
}

.cc-holder {
  text-transform: uppercase;
  font-weight: 500;
}

.cc-expiry {
  font-weight: 600;
}

/* Right: Info box */
.premium-info-box {
  flex: 1.1;
  background: #ffffff;
  padding: 18px 22px;
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.15);
  border-left: 6px solid #0473EA;
}

.premium-info-row {
  margin-bottom: 14px;
  display: flex;
  justify-content: space-between;
}

.label {
  color: #555;
  font-size: 14px;
}

.value {
  font-size: 15px;
  font-weight: 600;
  color: #1a2b5f;
}

/* Responsive */
@media (max-width: 900px) {
  .premium-layout {
    flex-direction: column;
    align-items: flex-start;
  }

  .premium-card-visual {
    width: 100%;
    justify-content: center;
    margin-bottom: 20px;
  }

  .credit-card-ui {
    width: 100%;
  }
}


.js


import React, { useState, useEffect } from "react";
import axios from "axios";
import "./Timeline.css";
import "./CardIssued.css";

const CardIssued = () => {
  const cardId = 3;
  const api = `http://localhost:8080/api/creditcards/${cardId}`;
  const [cardInfo, setCardInfo] = useState({});

  const loadCardDetails = async () => {
    try {
      const res = await axios.get(api);
      console.log("API Data:", res.data);
      setCardInfo(res.data);
    } catch (error) {
      console.log(error);
    }
  };

  useEffect(() => {
    loadCardDetails();
  }, []);

  useEffect(() => {
    console.log("State Updated:", cardInfo);
  }, [cardInfo]);

  return (
    <div className="row m-0 py-2">
      {/* Left Empty Space for Timeline */}
      <div id="progress-bar" className="col-3 py-2"></div>

      {/* Right Side Page Content */}
      <div id="progress-card" className="col-9 p-4 position-relative">
        <div className="premium-card-section">
          {/* Header */}
          <div className="premium-card-header">
            <h5>Credit Card Details</h5>
          </div>

          {/* Flex Layout */}
          <div className="premium-layout">
            
            {/* LEFT: Card Visual */}
            <div className="premium-card-visual">
              <div className="credit-card-ui">
                <div className="chip"></div>
                <div className="cc-number">
                  {cardInfo.maskedCardNumber || "XXXX-XXXX-XXXX-0123"}
                </div>
                <div className="cc-footer">
                  <span className="cc-holder">Card Holder</span>
                  <span className="cc-expiry">
                    {cardInfo.expiryDate || "12/30"}
                  </span>
                </div>
              </div>
            </div>

            {/* RIGHT: Info Pairs */}
            <div className="premium-info-box">
              <div className="premium-info-row">
                <span className="label">Card Type:</span>
                <span className="value">{cardInfo.cardType}</span>
              </div>

              <div className="premium-info-row">
                <span className="label">Issued Date:</span>
                <span className="value">
                  {cardInfo.generatedAt?.slice(0, 10) || ""}
                </span>
              </div>

              <div className="premium-info-row">
                <span className="label">Status:</span>
                <span className="value">{cardInfo.cardStatus}</span>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  );
};

export default CardIssued;