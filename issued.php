import React, { useState, useEffect } from "react";
import axios from "axios";
import "./Timeline.css";
import "./CardIssued.css";

const CardIssued = () => {
  const cardId = 3;
  const api = `http://localhost:8080/api/creditcards/${cardId}`;

  const [cardInfo, setCardInfo] = useState({});
  const [showPopup, setShowPopup] = useState(false);

  const deliverySteps = {
    "Not Printed": 1,
    Printed: 2,
    Dispatched: 3,
    Delivered: 4,
  };

  const currentStep = deliverySteps[cardInfo.deliveryStatus] || 1;

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

  const handleAccept = () => {
    setShowPopup(true);
  };

  const handleConfirm = () => {
    alert("Final approval confirmed and card process initiated.");
    setShowPopup(false);
  };

  const handleCancel = () => {
    setShowPopup(false);
  };

  return (
    <div className="row m-0 py-2">
      {/* Left Progress Bar */}
      <div id="progress-bar" className="col-3 py-2"></div>

      {/* Main Card */}
      <div id="progress-card" className="col-9 p-4 position-relative">
        <div className="premium-info-approval">
          <h5>Card details</h5>

          <div className="premium-info-row">
            <span className="label">Card Type:</span>
            <span className="value">{cardInfo.cardType || "N/A"}</span>
          </div>

          <div className="premium-info-row">
            <span className="label">Credit Limit:</span>
            <span className="value">Rs. 1,00,000</span>
          </div>

          <div className="premium-info-row">
            <span className="label">Interest Rate:</span>
            <span className="value">20%</span>
          </div>

          <div className="premium-info-row">
            <span className="label">Initial Acceptance:</span>
            <span className="value">Accepted</span>
          </div>

          <div className="button-group mt-3">
            <button className="accept-btn me-2" onClick={handleAccept}>
              Accept
            </button>
            <button className="reject-btn">Reject</button>
          </div>
        </div>

        {/* Credit Card UI */}
        <div className="premium-card-section">
          <h5>Credit Card Details</h5>

          <div className="premium-layout">
            <div className="premium-card-visual">
              <div className="credit-card-ui">
                <div className="bank-logo">
                  <img src="/Asset/Logos/try_scb_logo.png" alt="SCB" />
                </div>

                <div className="chip"></div>

                <div className="cc-number">
                  {cardInfo.maskedCardNumber || "XXXX-XXXX-XXXX-0123"}
                </div>

                <div className="cc-footer">
                  <span className="cc-holder">Card Holder</span>
                  <span className="cc-expiry">
                    Valid: {cardInfo.expiryDate?.slice(5, 7)}/{cardInfo.expiryDate?.slice(2, 4)}
                  </span>
                </div>
              </div>
            </div>

            <div className="premium-info-box">
              <div className="premium-info-row">
                <span className="label">Card Type:</span>
                <span className="value">{cardInfo.cardType || "N/A"}</span>
              </div>

              <div className="premium-info-row">
                <span className="label">Issued Date:</span>
                <span className="value">{cardInfo.generatedAt?.slice(0, 10)}</span>
              </div>

              <div className="premium-info-row">
                <span className="label">Status:</span>
                <span className="value">{cardInfo.deliveryStatus || "Unknown"}</span>
              </div>
            </div>
          </div>
        </div>

        {/* Action Buttons */}
        <div className="action-btn-container">
          <button className="premium-btn print-btn">Print</button>
          <button className="premium-btn email-btn">Send Email</button>
        </div>

        {/* Confirm Popup */}
        {showPopup && (
          <div className="popup-overlay">
            <div className="popup-box">
              <h5><strong>Confirm Final Approval</strong></h5>
              <p>
                By clicking <strong>Confirm</strong>, you are confirming the Credit Card is{" "}
                <strong>Ready to Issue</strong>.
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

        {/* Delivery Steps */}
        <div className="delivery-status-container">
          {["Not Printed", "Printed", "Dispatched", "Delivered"].map((step, i) => (
            <div key={i} className={`delivery-step ${currentStep > i ? "active" : ""}`}>
              <span className="delivery-circle"></span>
              <span className="delivery-label">{step}</span>
              {i < 3 && <div className="delivery-line"></div>}
            </div>
          ))}
        </div>
      </div>
    </div>
  );
};

export default CardIssued;


update



  <div className="delivery-status-container">
    {/*
      Minimal & safe: use the numeric currentStep you already compute earlier:
      const currentStep = deliverySteps[cardInfo.deliveryStatus] || 1;
      Each step becomes "active" when currentStep >= that step number.
    */}
    <div className={`delivery-step ${currentStep >= 1 ? "active" : ""}`}>
      <span className="delivery-circle" />
      <span className="delivery-label">Sent to Print</span>
    </div>

    <div className="delivery-line" />

    <div className={`delivery-step ${currentStep >= 2 ? "active" : ""}`}>
      <span className="delivery-circle" />
      <span className="delivery-label">Printed</span>
    </div>

    <div className="delivery-line" />

    <div className={`delivery-step ${currentStep >= 3 ? "active" : ""}`}>
      <span className="delivery-circle" />
      <span className="delivery-label">Dispatched</span>
    </div>

    <div className="delivery-line" />

    <div className={`delivery-step ${currentStep >= 4 ? "active" : ""}`}>
      <span className="delivery-circle" />
      <span className="delivery-label">Delivered</span>
    </div>
  </div>
