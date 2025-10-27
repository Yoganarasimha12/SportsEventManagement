cardissued.js


import React, { useState, useEffect } from "react";
import axios from "axios";

import "./CardIssued.css";

const CardIssued = () => {
  const cardId = 3;
  const api = `http://localhost:8080/api/creditcards/${cardId}`;

  const [cardInfo, setCardInfo] = useState({});
  const [approved, setApproved] = useState(false);
  const [showPopup, setShowPopup] = useState(false);

  const loadCardDetails = async () => {
    try {
      const res = await axios.get(api);
      setCardInfo(res.data);
    } catch (error) {
      console.log(error);
    }
  };

  useEffect(() => {
    loadCardDetails();
  }, []);

  const handleAccept = () => {
    setShowPopup(true);
  };

  const confirmApproval = () => {
    setApproved(true);
    setShowPopup(false);
    alert("✅ Final approval confirmed!");
  };

  const cancelPopup = () => {
    setShowPopup(false);
  };

  const handleReject = () => {
    alert("Card Application Rejected ❌");
  };

  return (
  <div className="row m-0 py-2">

    {/* Timeline Placeholder */}
    <div id="progress-bar" className="col-3 py-2"></div>

    {/* ✅ RIGHT SIDE CONTENT */}
    <div id="progress-card" className="col-9 p-4 position-relative">

      {/* ✅ Final Approval Container */}
      {!isApproved && (
        <div className="approval-box">
          <h5 className="section-title">Final Approval</h5>
          <div className="approval-info">
            <p className="info-line"><strong>Card Type:</strong> {cardInfo.cardType}</p>
            <p className="info-line"><strong>Approved Limit:</strong> ₹1,00,000</p>
            <p className="info-line"><strong>Interest Rate:</strong> 20%</p>
          </div>

          <div className="btn-group">
            <button className="accept-btn" onClick={handleAccept}>
              Accept
            </button>
            <button className="reject-btn" onClick={handleReject}>
              Reject
            </button>
          </div>
        </div>
      )}

      {/* ✅ Card Issued Section — shows only after approval */}
      {isApproved && (
        <div className="premium-card-section">
          
          <div className="premium-layout">
            {/* Card */}
            <div className="premium-card-visual">
              <div className="credit-card-ui">
                <div className="bank-logo">
                  <img src="/Assets/Logos/try_scb_logo.png" alt="SCB Logo" />
                </div>

                <div className="chip"></div>

                <div className="cc-number">
                  {cardInfo.maskedCardNumber || "XXXX-XXXX-XXXX-0123"}
                </div>

                <div className="cc-footer">
                  <span className="cc-holder">Card Holder</span>
                  <span className="cc-expiry">
                    VALID: {cardInfo.expiryDate ? `${cardInfo.expiryDate.slice(5,7)}/${cardInfo.expiryDate.slice(2,4)}` : ""}
                  </span>
                </div>
              </div>
            </div>

            {/* Right Info */}
            <div className="premium-info-box">
              <div className="premium-info-row">
                <span className="label">Card Type:</span>
                <span className="value">{cardInfo.cardType}</span>
              </div>

              <div className="premium-info-row">
                <span className="label">Issued Date:</span>
                <span className="value">{cardInfo.generatedAt?.slice(0, 10)}</span>
              </div>

              <div className="premium-info-row">
                <span className="label">Status:</span>
                <span className="value">{cardInfo.cardStatus}</span>
              </div>
            </div>
          </div>
        </div>
      )}

    </div>

    {/* ✅ Popup */}
    {showPopup && (
      <div className="popup-overlay">
        <div className="popup-box">
          <h5><strong>Confirm Final Approval</strong></h5>
          <p>Once confirmed, card will be issued.</p>
          <div className="popup-buttons">
            <button className="confirm-btn" onClick={handleConfirm}>Confirm</button>
            <button className="cancel-btn" onClick={handleCancel}>Cancel</button>
          </div>
        </div>
      </div>
    )}

 <div className="delivery-timeline-container">
        <div className={`timeline-step ${cardInfo.deliveryStatus >= 1 ? "active" : ""}`}>
          <span className="step-circle"></span>
          <span className="step-label">Sent to Print</span>
        </div>
        <div className="timeline-divider"></div>
        <div className={`timeline-step ${cardInfo.deliveryStatus >= 2 ? "active" : ""}`}>
          <span className="step-circle"></span>
          <span className="step-label">Printed</span>
        </div>
        <div className="timeline-divider"></div>
        <div className={`timeline-step ${cardInfo.deliveryStatus >= 3 ? "active" : ""}`}>
          <span className="step-circle"></span>
          <span className="step-label">Dispatched</span>
        </div>
        <div className="timeline-divider"></div>
        <div className={`timeline-step ${cardInfo.deliveryStatus >= 4 ? "active" : ""}`}>
          <span className="step-circle"></span>
          <span className="step-label">Delivered</span>
        </div>
      </div>
    </div>
  </div>
);
  </div>
);
};

export default CardIssued;



cardissued.css

/* ✅ FINAL APPROVAL SECTION */
.approval-box {
  width: 85%;
  background: #ffffff;
  padding: 18px 25px;
  margin-left: 10px;
  border-radius: 14px;
  box-shadow: 0 8px 18px rgba(0,0,0,0.15);
  border-left: 6px solid #0473EA;
}

.section-title {
  font-size: 20px;
  font-weight: 600;
  color: #0473EA;
  margin-bottom: 14px;
}

.approval-info {
  font-size: 15px;
  margin-bottom: 12px;
}

.info-line {
  margin-bottom: 6px;
  color: #243A73;
}

.btn-group {
  margin-top: 8px;
  display: flex;
  gap: 12px;
}

.accept-btn {
  background: #0473EA;
  border: none;
  padding: 6px 18px;
  color: #fff;
  border-radius: 6px;
  cursor: pointer;
  font-weight: 600;
}

.reject-btn {
  background: #b30000;
  border: none;
  padding: 6px 18px;
  color: #fff;
  border-radius: 6px;
  cursor: pointer;
  font-weight: 600;
}


/* ✅ CARD ISSUED LAYOUT */
.premium-card-section {
  width: 85%;
  padding: 10px;
  margin-left: 10px;
  border-radius: 16px;
  margin-top: 20px;
}

.premium-layout {
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 28px;
}


/* ✅ LEFT: CARD VISUAL */
.premium-card-visual {
  flex: 1.3;
}

.credit-card-ui {
  background: linear-gradient(145deg, #1b3c56, #5a4a97);
  width: 340px;
  height: 190px;
  padding: 20px;
  border-radius: 18px;
  color: #fff;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  position: relative;
  box-shadow: 0 20px 25px rgba(0, 0, 0, 0.35);
}

.bank-logo {
  position: absolute;
  top: 5px;
  right: 12px;
}

.bank-logo img {
  height: 60px;
  object-fit: contain;
  opacity: 0.95;
}

.chip {
  width: 42px;
  height: 28px;
  background: linear-gradient(135deg, gold, #ccac00);
  border-radius: 6px;
}

.cc-number {
  font-size: 19px;
  text-align: center;
  letter-spacing: 3px;
  font-weight: 600;
}

.cc-footer {
  display: flex;
  justify-content: space-between;
  font-size: 14px;
}

.cc-holder,
.cc-expiry {
  font-family: "OCR A Std", monospace;
  text-transform: uppercase;
  font-weight: 600;
  background: linear-gradient(135deg, #ffffff 0%, #d9d9d9 45%, #a0a0a0 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}


/* ✅ RIGHT: INFO PANEL */
.premium-info-box {
  background: #ffffff;
  flex: 1.9;
  padding: 28px 22px;
  border-radius: 14px;
  box-shadow: 0 18px 22px rgba(0,0,0,0.18);
  border-left: 6px solid #0473EA;
}

.premium-info-row {
  margin-bottom: 16px;
  display: flex;
  align-items: center;
}

.label {
  width: 140px;
  font-size: 16px;
  color: #555;
}

.value {
  font-size: 16px;
  font-weight: 600;
  color: #1a2b5f;
}


/* ✅ PREMIUM POPUP */
.popup-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0,0,0,0.45);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 999;
}

.popup-box {
  background: #fff;
  padding: 25px 30px;
  border-radius: 14px;
  width: 350px;
  text-align: center;
  animation: scaleIn 0.3s ease;
  box-shadow: 0 10px 25px rgba(0,0,0,0.25);
}

@keyframes scaleIn {
  from { transform: scale(0.7); opacity: 0; }
  to { transform: scale(1); opacity: 1; }
}

.popup-buttons {
  margin-top: 20px;
  display: flex;
  justify-content: space-between;
}

.confirm-btn {
  background: #0473EA;
  color: #fff;
  padding: 8px 18px;
  border-radius: 8px;
  border: none;
  cursor: pointer;
}

.cancel-btn {
  background: #777;
  color: #fff;
  padding: 8px 18px;
  border-radius: 8px;
  border: none;
  cursor: pointer;
}

card delivery timeline

.delivery-timeline-container {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin: 25px 0;
  padding: 20px;
  background: rgba(255,255,255,0.05);
  border-radius: 15px;
  backdrop-filter: blur(8px);
  border: 1px solid rgba(255,255,255,0.1);
}

.timeline-step {
  display: flex;
  flex-direction: column;
  align-items: center;
  width: 25%;
  text-align: center;
}

.step-circle {
  width: 28px;
  height: 28px;
  border-radius: 50%;
  border: 3px solid #777;
  background-color: #222;
  transition: 0.3s ease-in-out;
}

.timeline-step.active .step-circle {
  background: linear-gradient(135deg, #00704A, #00A97F);
  border-color: #00c597;
  box-shadow: 0 0 10px rgba(0,255,200,0.6);
}

.step-label {
  margin-top: 8px;
  font-size: 13px;
  font-weight: 600;
  color: white;
  opacity: 0.6;
  transition: 0.3s;
}

.timeline-step.active .step-label {
  opacity: 1;
}

.timeline-divider {
  flex-grow: 1;
  height: 3px;
  background: #555;
  margin: 0 6px;
  transition: 0.3s ease-in-out;
}


update

{/* Bottom Delivery Timeline */}
<div className="delivery-status-container">

  <div className={`delivery-step ${cardInfo.deliveryStatus >= 1 ? "active" : ""}`}>
    <span className="delivery-circle"></span>
    <span className="delivery-label">Sent to Print</span>
  </div>

  <div className="delivery-line"></div>

  <div className={`delivery-step ${cardInfo.deliveryStatus >= 2 ? "active" : ""}`}>
    <span className="delivery-circle"></span>
    <span className="delivery-label">Printed</span>
  </div>

  <div className="delivery-line"></div>

  <div className={`delivery-step ${cardInfo.deliveryStatus >= 3 ? "active" : ""}`}>
    <span className="delivery-circle"></span>
    <span className="delivery-label">Dispatched</span>
  </div>

  <div className="delivery-line"></div>

  <div className={`delivery-step ${cardInfo.deliveryStatus >= 4 ? "active" : ""}`}>
    <span className="delivery-circle"></span>
    <span className="delivery-label">Delivered</span>
  </div>

</div>