import React, { useState, useEffect } from "react";
import { useParams } from "react-router-dom";
import axios from "axios";
import Timeline from "./Timeline";
import "./Timeline.css";
import "./CardIssued.css";

function FinalApproval(props) {
  // ✅ Read params from URL
  const { applicationId, currentStage } = useParams();

  // ✅ State management
  const [cardInfo, setCardInfo] = useState({});
  const [showPopup, setShowPopup] = useState(false);

  // ✅ Determine which stage to show in the timeline
  const stage = props.applicationInfo?.currentStage || currentStage;

  // ✅ Delivery step mapping
  const deliverySteps = {
    "Not Printed": 1,
    "Printed": 2,
    "Dispatched": 3,
    "Delivered": 4,
  };

  const currentStep = deliverySteps[cardInfo.deliveryStatus] || 1;

  // ✅ Fetch credit card details using applicationId
  const loadCardDetails = async () => {
    try {
      const api = `http://localhost:8080/api/creditcards/${applicationId}`;
      const res = await axios.get(api);
      console.log("Fetched Credit Card Details:", res.data);
      setCardInfo(res.data);
    } catch (error) {
      console.error("Error fetching credit card details:", error);
    }
  };

  useEffect(() => {
    loadCardDetails();
  }, [applicationId]);

  // ✅ Popup Handlers
  const handleAccept = () => {
    setShowPopup(true);
  };

  const handleConfirm = async () => {
    alert("Final approval confirmed and card process initiated.");
    setShowPopup(false);

    // Optionally, you can call a PUT API here to update status:
    // await axios.put(`http://localhost:8080/api/creditcards/update-status/${applicationId}`, { cardStatus: "Approved" });
  };

  const handleCancel = () => {
    setShowPopup(false);
  };

  return (
    <div className="row m-0 py-2">
      {/* Left: Timeline */}
      <div id="progress-bar" className="col-3 py-2">
        <Timeline currentStage={stage} />
      </div>

      {/* Right: Card Info Section */}
      <div id="progress-card" className="col-9 p-4 position-relative">
        <div className="premium-info-approval">
          {/* Card Details Header */}
          <div id="progress-card-header" className="mb-3">
            <h5>Card Details</h5>
          </div>

          {/* Card Info Rows */}
          <div className="d-flex justify-content-start py-2">
            <div className="premium-info-row">
              <span className="label">Card Type:</span>
              <span className="value">{cardInfo.cardType || "-"}</span>
            </div>
          </div>

          <div className="d-flex justify-content-start py-2">
            <div className="premium-info-row">
              <span className="label">Credit Limit:</span>
              <span className="value">Rs. 1,00,000</span>
            </div>
          </div>

          <div className="d-flex justify-content-start py-2">
            <div className="premium-info-row">
              <span className="label">Interest Rate:</span>
              <span className="value">20%</span>
            </div>
          </div>

          <div className="d-flex justify-content-start py-2">
            <div className="premium-info-row">
              <span className="label">Initial Acceptance:</span>
              <span className="value">Accepted</span>
            </div>
          </div>

          {/* Action Buttons */}
          <div className="button-group mt-3">
            <button className="accept-btn me-2" onClick={handleAccept}>
              Accept
            </button>
            <button className="reject-btn">Reject</button>
          </div>
        </div>

        {/* Credit Card Visual Section */}
        <div className="premium-card-section mt-5">
          {/* Header */}
          <div className="premium-card-header">
            <h5>Credit Card Details</h5>
          </div>

          {/* Layout */}
          <div className="premium-layout">
            {/* Left: Card Visual */}
            <div className="premium-card-visual">
              <div className="credit-card-ui">
                <div className="bank-logo">
                  <img
                    src="/Asset/Logos/try_scb_logo.png"
                    alt="Standard Chartered"
                  />
                </div>
                <div className="chip"></div>
                <div className="cc-number">
                  {cardInfo.maskedCardNumber || "XXXX-XXXX-XXXX-0123"}
                </div>
                <div className="cc-footer">
                  <span className="cc-holder">Card Holder</span>
                  <span className="cc-expiry">
                    {cardInfo.expiryDate
                      ? `Valid: ${cardInfo.expiryDate.slice(5, 7)}/${cardInfo.expiryDate.slice(2, 4)}`
                      : "Valid: --/--"}
                  </span>
                </div>
              </div>
            </div>

            {/* Right: Info */}
            <div className="premium-info-box">
              <div className="premium-info-row">
                <span className="label">Card Type:</span>
                <span className="value">{cardInfo.cardType || "-"}</span>
              </div>

              <div className="premium-info-row">
                <span className="label">Issued Date:</span>
                <span className="value">
                  {cardInfo.generatedAt
                    ? cardInfo.generatedAt.slice(0, 10)
                    : "-"}
                </span>
              </div>

              <div className="premium-info-row">
                <span className="label">Status:</span>
                <span className="value">{cardInfo.cardStatus || "-"}</span>
              </div>
            </div>
          </div>
        </div>

        {/* Delivery Status Steps */}
        <div className="delivery-status-container mt-4">
          <div className={`delivery-step ${currentStep >= 1 ? "active" : ""}`}>
            <span className="delivery-circle" />
            <span className="delivery-label">Sent to Print</span>
          </div>

          <div className={`delivery-step ${currentStep >= 2 ? "active" : ""}`}>
            <span className="delivery-circle" />
            <span className="delivery-label">Printed</span>
          </div>

          <div className={`delivery-step ${currentStep >= 3 ? "active" : ""}`}>
            <span className="delivery-circle" />
            <span className="delivery-label">Dispatched</span>
          </div>

          <div className={`delivery-step ${currentStep >= 4 ? "active" : ""}`}>
            <span className="delivery-circle" />
            <span className="delivery-label">Delivered</span>
          </div>
        </div>

        {/* Action Buttons Below */}
        <div className="action-btn-container mt-4">
          <button className="premium-btn print-btn">Print</button>
          <button className="premium-btn email-btn">Send Email</button>
        </div>

        {/* Popup Modal */}
        {showPopup && (
          <div className="popup-overlay">
            <div className="popup-box">
              <h5>
                <strong>Confirm Final Approval</strong>
              </h5>
              <p>
                By clicking <strong>Confirm</strong>, you are confirming the
                Credit Card is <strong>Ready to Issue.</strong>
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
}

export default FinalApproval;