card issued premium card section-2


<div className="premium-card-section">
  <div className="premium-card-header">
    <h5>Credit Card Details</h5>
  </div>

  <div className="premium-card-content">
    {/* LEFT SIDE - info pairs */}
    <div className="card-info-left">
      <div className="info-row">
        <span className="info-label">Card Type:</span>
        <span className="info-value">{cardInfo.card_type}</span>
      </div>
      <div className="info-row">
        <span className="info-label">Issued Date:</span>
        <span className="info-value">{cardInfo.issued_at}</span>
      </div>
      <div className="info-row">
        <span className="info-label">Status:</span>
        <span className="info-value">{cardInfo.status}</span>
      </div>
    </div>

    {/* RIGHT SIDE - visual card */}
    <div className="card-visual">
      <div className="credit-card">
        <div className="chip"></div>
        <div className="card-number">
          {cardInfo.card_number || "**** **** **** 2345"}
        </div>
        <div className="card-footer">
          <div className="card-holder">VINAY RAO</div>
          <div className="expiry">
            Exp: {cardInfo.expiry_date || "12/30"}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



issued.css -2


/* ======= Premium Card Details Section ======= */
.premium-card-section {
  background: #0b132b;
  color: #fff;
  border-radius: 16px;
  padding: 30px 40px;
  width: 85%;
  margin-left: 50px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.25);
}

.premium-card-header h5 {
  color: #ffffff;
  font-size: 20px;
  font-weight: 600;
  border-bottom: 1px solid rgba(255, 255, 255, 0.2);
  padding-bottom: 10px;
  margin-bottom: 25px;
}

/* Split layout */
.premium-card-content {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

/* LEFT SIDE INFO */
.card-info-left {
  flex: 1;
}

.info-row {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 12px;
  max-width: 300px;
}

.info-label {
  color: #cfd2dc;
  font-size: 14px;
  width: 120px;
}

.info-value {
  color: #ffffff;
  font-weight: 600;
}

/* RIGHT SIDE - CREDIT CARD VISUAL */
.card-visual {
  flex: 1;
  display: flex;
  justify-content: flex-end;
}

.credit-card {
  background: linear-gradient(135deg, #2b5876, #4e4376);
  border-radius: 16px;
  padding: 20px;
  width: 320px;
  height: 190px;
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
  position: relative;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

/* Small chip icon */
.chip {
  width: 40px;
  height: 28px;
  background: linear-gradient(135deg, #d9d9d9, #b5b5b5);
  border-radius: 5px;
}

.card-number {
  font-size: 20px;
  letter-spacing: 3px;
  text-align: left;
  font-weight: 600;
}

.card-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-size: 14px;
}

.card-holder {
  text-transform: uppercase;
  font-weight: 500;
}

.expiry {
  font-weight: 500;
}

/* Responsive */
@media (max-width: 900px) {
  .premium-card-content {
    flex-direction: column;
    align-items: flex-start;
  }

  .card-visual {
    justify-content: center;
    margin-top: 20px;
    width: 100%;
  }
}

Final approval.js updated


import React, { useState, useEffect } from "react";
import axios from "axios";
import "./FinalApproval.css";
import "./Timeline.css";

const FinalApproval = () => {
  const applicationId = 1; // hardcoded for now
  const api = `http://localhost:8080/api/customers/${applicationId}`;
  const [applicantInfo, setApplicantInfo] = useState({});
  const [showPopup, setShowPopup] = useState(false);

  useEffect(() => {
    const loadApplicantDetails = async () => {
      try {
        const res = await axios.get(api);
        setApplicantInfo(res.data);
      } catch (error) {
        console.log(error);
      }
    };
    loadApplicantDetails();
  }, []);

  const handleAccept = () => setShowPopup(true);
  const handleConfirm = () => {
    alert("Final approval confirmed and card process initiated.");
    setShowPopup(false);
  };
  const handleCancel = () => setShowPopup(false);

  return (
    <div className="row m-0 py-2">
      <div id="progress-bar" className="col-3 py-2 d-flex flex-column align-items-start">
        {/* <Timeline/> */}
      </div>

      <div id="progress-card" className="col-9 p-4 position-relative">
        {/* Subtle container for all details */}
        <div className="approval-container">
          <div className="section-header">
            <h5>Final Approval</h5>
          </div>

          {/* Basic Details */}
          <div className="details-section">
            <h6>Basic Details</h6>
            <div className="info-grid">
              <div className="info-item">
                <span className="label">Date of Birth:</span>
                <span className="value">{applicantInfo.date_of_birth}</span>
              </div>
              <div className="info-item">
                <span className="label">Email:</span>
                <span className="value">{applicantInfo.email}</span>
              </div>
              <div className="info-item">
                <span className="label">Contact Number:</span>
                <span className="value">{applicantInfo.phone}</span>
              </div>
            </div>
          </div>

          {/* Card Details */}
          <div className="details-section">
            <h6>Card Details</h6>
            <div className="info-grid">
              <div className="info-item">
                <span className="label">Card Type:</span>
                <span className="value">Gold</span>
              </div>
              <div className="info-item">
                <span className="label">Approved Credit Limit:</span>
                <span className="value">Rs. 1,00,000</span>
              </div>
              <div className="info-item">
                <span className="label">Interest Rate:</span>
                <span className="value">20%</span>
              </div>
              <div className="info-item">
                <span className="label">Initial Acceptance Status:</span>
                <span className="value">Accepted</span>
              </div>
            </div>
          </div>

          {/* Buttons */}
          <div className="button-group mt-4">
            <button className="accept-btn me-2" onClick={handleAccept}>
              Accept
            </button>
            <button className="reject-btn">Reject</button>
          </div>
        </div>

        {/* Popup */}
        {showPopup && (
          <div className="popup-overlay">
            <div className="popup-box">
              <h5>
                <strong>Confirm Final Approval</strong>
              </h5>
              <p>
                By clicking <strong>Confirm</strong>, you are confirming the credit card is{" "}
                <strong>Ready to Issue.</strong>
              </p>
              <div className="popup-buttons">
                <button className="confirm-btn" onClick={handleConfirm}>
                  Confirm
                </button>
                <button className="cancel-btn" onClick={handleCancel}>
                  Cancel
                </button>
              </div>
            </div>
          </div>
        )}
      </div>
    </div>
  );
};

export default FinalApproval;



FinalApproval.css


/* ========== Main Approval Container ========== */
.approval-container {
  background: #f9fafc;
  border: 1px solid #e4e6eb;
  border-radius: 12px;
  padding: 30px 40px;
  box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);
  transition: all 0.3s ease;
}

.section-header h5 {
  font-weight: 600;
  color: #0b132b;
  margin-bottom: 20px;
  font-size: 22px;
}

.details-section {
  margin-bottom: 30px;
}

.details-section h6 {
  font-weight: 600;
  color: #0473ea;
  margin-bottom: 15px;
  font-size: 16px;
}

/* Info Grid - clean and aligned layout */
.info-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 12px 60px;
}

.info-item {
  display: flex;
  justify-content: space-between;
}

.label {
  color: #555;
  font-weight: 500;
  font-size: 14px;
}

.value {
  color: #1b1b1b;
  font-weight: 600;
  font-size: 14px;
}

/* Buttons */
.button-group {
  display: flex;
  justify-content: flex-end;
  gap: 10px;
}

.accept-btn {
  background: #0473ea;
  color: #fff;
  padding: 8px 20px;
  border: none;
  border-radius: 6px;
  font-weight: 500;
  cursor: pointer;
  transition: 0.25s;
}

.accept-btn:hover {
  background: #035ccd;
}

.reject-btn {
  background: #e24e48;
  color: white;
  padding: 8px 20px;
  border: none;
  border-radius: 6px;
  font-weight: 500;
  cursor: pointer;
  transition: 0.25s;
}

.reject-btn:hover {
  background: #c63c36;
}

/* Popup */
.popup-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.4);
  display: flex;
  justify-content: center;
  align-items: center;
}

.popup-box {
  background: white;
  padding: 25px 30px;
  border-radius: 12px;
  width: 450px;
  box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
}

.popup-buttons {
  display: flex;
  justify-content: flex-end;
  gap: 12px;
  margin-top: 20px;
}

.confirm-btn {
  background: #38d200;
  color: #fff;
  padding: 8px 18px;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  font-weight: 500;
}

.confirm-btn:hover {
  background-color: #1ea733;
}

.cancel-btn {
  background: #a3a3a3;
  color: #fff;
  padding: 8px 18px;
  border: none;
  border-radius: 6px;
  cursor: pointer;
}

.cancel-btn:hover {
  opacity: 0.85;
}

Final approval.js Combined

import React, { useState, useEffect } from "react";
import axios from "axios";
import "./FinalApproval.css";

const FinalApproval = () => {
  const applicationId = 1; // demo id for now

  const customerApi = `http://localhost:8080/api/customers/${applicationId}`;
  const cardApi = `http://localhost:8080/api/creditcards/${applicationId}`;

  const [applicantInfo, setApplicantInfo] = useState({});
  const [cardInfo, setCardInfo] = useState({});
  const [showPopup, setShowPopup] = useState(false);
  const [showCard, setShowCard] = useState(false);

  // Load both customer and card data
  useEffect(() => {
    const loadData = async () => {
      try {
        const [customerRes, cardRes] = await Promise.all([
          axios.get(customerApi),
          axios.get(cardApi),
        ]);
        setApplicantInfo(customerRes.data);
        setCardInfo(cardRes.data);

        // Automatically show card if already issued
        if (cardRes.data.status === "ISSUED") setShowCard(true);
      } catch (error) {
        console.log(error);
      }
    };
    loadData();
  }, []);

  // Handlers
  const handleAccept = () => setShowPopup(true);
  const handleConfirm = () => {
    alert("Final approval confirmed — card issued successfully.");
    setShowPopup(false);
    setShowCard(true);
  };
  const handleCancel = () => setShowPopup(false);

  return (
    <div className="row m-0 py-2">
      <div id="progress-bar" className="col-3 py-2 d-flex flex-column align-items-start">
        {/* <Timeline /> */}
      </div>

      {/* Main container */}
      <div id="progress-card" className="col-9 p-4 position-relative">

        {/* Basic Details */}
        <div className="section-container">
          <div className="section-header">
            <h5>Basic Details</h5>
          </div>
          <div className="details-grid">
            <div>
              <span className="label">Date of Birth:</span>
              <span className="value">{applicantInfo.date_of_birth}</span>
            </div>
            <div>
              <span className="label">Email:</span>
              <span className="value">{applicantInfo.email}</span>
            </div>
            <div>
              <span className="label">Contact Number:</span>
              <span className="value">{applicantInfo.phone}</span>
            </div>
          </div>
        </div>

        {/* Card Details */}
        <div className="section-container mt-4">
          <div className="section-header">
            <h5>Card Details</h5>
          </div>
          <div className="details-grid">
            <div>
              <span className="label">Card Type:</span>
              <span className="value">{cardInfo.card_type || "GOLD"}</span>
            </div>
            <div>
              <span className="label">Approved Limit:</span>
              <span className="value">₹{cardInfo.credit_limit || "1,00,000"}</span>
            </div>
            <div>
              <span className="label">Interest Rate:</span>
              <span className="value">{cardInfo.interest_rate || "20%"} </span>
            </div>
            <div>
              <span className="label">Initial Status:</span>
              <span className="value">{cardInfo.status || "Accepted"}</span>
            </div>
          </div>
        </div>

        {/* Buttons */}
        <div className="button-group mt-4">
          <button className="accept-btn me-2" onClick={handleAccept}>
            Accept
          </button>
          <button className="reject-btn">Reject</button>
        </div>

        {/* Popup */}
        {showPopup && (
          <div className="popup-overlay">
            <div className="popup-box">
              <h5><strong>Confirm Final Approval</strong></h5>
              <p>
                By clicking <strong>Confirm</strong>, you are confirming the credit card is
                <strong> Ready to Issue.</strong>
              </p>
              <div className="popup-buttons">
                <button className="confirm-btn" onClick={handleConfirm}>
                  Confirm
                </button>
                <button className="cancel-btn" onClick={handleCancel}>
                  Cancel
                </button>
              </div>
            </div>
          </div>
        )}

        {/* Issued Card Section */}
        {showCard && (
          <div className="issued-card-container mt-5">
            <div className="issued-card-info">
              <h6>Card Issued Details</h6>
              <div className="issued-details-grid">
                <div>
                  <span className="label">Issued At:</span>
                  <span className="value">{cardInfo.issued_at}</span>
                </div>
                <div>
                  <span className="label">Expiry Date:</span>
                  <span className="value">{cardInfo.expiry_date}</span>
                </div>
                <div>
                  <span className="label">Status:</span>
                  <span className="value">{cardInfo.status}</span>
                </div>
              </div>
            </div>

            {/* Right side Credit Card */}
            <div className="credit-card-visual">
              <div className="credit-card">
                <div className="card-chip"></div>
                <div className="card-number">{cardInfo.card_number || "1234 5678 9012 3456"}</div>
                <div className="card-footer">
                  <div className="card-type">{cardInfo.card_type || "Gold"}</div>
                  <div className="expiry">Exp: {cardInfo.expiry_date || "08/30"}</div>
                </div>
              </div>
            </div>
          </div>
        )}
      </div>
    </div>
  );
};

export default FinalApproval;



Finalapproval.css combined


/* ====== General Layout ====== */
#progress-card {
  width: 920px;
  border-radius: 12px;
  background: #fff;
  box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
  transition: all 0.3s ease;
}

/* ====== Section Containers ====== */
.section-container {
  background: #f9fafc;
  padding: 20px 25px;
  border-radius: 10px;
  box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.03);
}

.section-header h5 {
  color: #0473ea;
  font-weight: 600;
  border-left: 4px solid #0473ea;
  padding-left: 10px;
  margin-bottom: 15px;
}

/* ====== Details Grid ====== */
.details-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 14px 60px;
}

.label {
  color: #666;
  font-weight: 500;
  margin-right: 6px;
}

.value {
  color: #111;
  font-weight: 600;
}

/* ====== Buttons ====== */
.button-group {
  display: flex;
  justify-content: flex-end;
  gap: 10px;
  margin-top: 20px;
}

.accept-btn {
  background: #0473ea;
  color: #fff;
  padding: 10px 24px;
  border: none;
  border-radius: 8px;
  font-size: 14.5px;
  font-weight: 500;
  cursor: pointer;
  transition: background 0.25s ease, transform 0.15s ease;
}

.accept-btn:hover {
  background: #0359b6;
  transform: translateY(-1px);
}

.reject-btn {
  background: #e24e48;
  color: #fff;
  padding: 10px 24px;
  border: none;
  border-radius: 8px;
  font-size: 14.5px;
  font-weight: 500;
  cursor: pointer;
  transition: background 0.25s ease, transform 0.15s ease;
}

.reject-btn:hover {
  background: #b33a36;
  transform: translateY(-1px);
}

/* ====== Popup ====== */
.popup-overlay {
  position: fixed;
  top: 0; left: 0;
  width: 100%; height: 100%;
  background: rgba(0, 0, 0, 0.4);
  display: flex; justify-content: center; align-items: center;
}

.popup-box {
  background: white;
  padding: 25px;
  border-radius: 10px;
  text-align: left;
  width: 520px;
  box-shadow: 0 0 8px rgba(0, 0, 0, 0.3);
}

.popup-buttons {
  margin-top: 20px;
  display: flex;
  justify-content: flex-end;
  gap: 12px;
}

.confirm-btn {
  background: #38d200;
  color: white;
  padding: 8px 18px;
  border: none;
  border-radius: 6px;
  cursor: pointer;
}

.confirm-btn:hover {
  background-color: #1ea733;
  transition: 0.25s;
}

.cancel-btn {
  background: #a3a3a3;
  color: white;
  padding: 8px 18px;
  border: none;
  border-radius: 6px;
  cursor: pointer;
}

.cancel-btn:hover {
  opacity: 0.8;
}

/* ====== Issued Card Section ====== */
.issued-card-container {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background: #f9fafc;
  border-radius: 12px;
  padding: 25px 35px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}

.issued-card-info h6 {
  color: #0473ea;
  font-weight: 600;
  margin-bottom: 15px;
}

.issued-details-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 10px 40px;
}

/* ====== Credit Card Visual ====== */
.credit-card-visual {
  display: flex;
  justify-content: flex-end;
  align-items: center;
  flex: 0 0 320px;
}

.credit-card {
  width: 320px;
  height: 190px;
  border-radius: 16px;
  padding: 20px;
  background: linear-gradient(135deg, #0473ea, #021f4f);
  color: #fff;
  box-shadow: 0 10px 20px rgba(4, 115, 234, 0.2);
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

.card-chip {
  width: 40px;
  height: 30px;
  background: gold;
  border-radius: 6px;
}

.card-number {
  font-size: 20px;
  letter-spacing: 2px;
  font-weight: 600;
  text-align: left;
}

.card-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-size: 14px;
  opacity: 0.9;
}

.card-type {
  font-weight: 600;
  text-transform: uppercase;
}