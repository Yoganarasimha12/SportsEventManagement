import React, { useState, useEffect } from "react";
import { useParams } from "react-router-dom";
import axios from "axios";
import Timeline from "./Timeline";
import "./CardIssued.css";
import "./Timeline.css";

function FinalApproval(props) {
  const { applicationId, currentStage } = useParams();
  const [cardInfo, setCardInfo] = useState({});
  const [showPopup, setShowPopup] = useState(false);
  const [showCardDetails, setShowCardDetails] = useState(false);
  const [appStatus, setAppStatus] = useState("");
  const stage = props.applicationInfo?.currentStage || currentStage;

  // 🧩 Fetch existing credit card details (if already approved)
  const loadCardDetails = async () => {
    try {
      const res = await axios.get(
        `http://localhost:8080/api/creditcards/${applicationId}`
      );
      setCardInfo(res.data);
      setShowCardDetails(true);
      setAppStatus("Approved");
    } catch (err) {
      console.log("No card yet or error:", err.message);
    }
  };

  useEffect(() => {
    loadCardDetails();
  }, []);

  // 🟢 Accept button — show confirm popup
  const handleAccept = () => {
    setShowPopup(true);
  };

  // 🟢 Confirm approval — update status + create card
  const handleConfirm = async () => {
    try {
      // 1️⃣ Update application status and create credit card on backend
      await axios.put(
        `http://localhost:8080/api/applications/${applicationId}/status?status=Approved`
      );

      // 2️⃣ Reload card details from backend
      await loadCardDetails();

      // 3️⃣ Update UI
      setShowPopup(false);
      setShowCardDetails(true);
      setAppStatus("Approved");
    } catch (err) {
      console.error("Error approving:", err);
      alert("Error approving application");
    }
  };

  // 🔴 Reject button — update status only
  const handleReject = async () => {
    try {
      await axios.put(
        `http://localhost:8080/api/applications/${applicationId}/status?status=Rejected`
      );
      setAppStatus("Rejected");
      setShowCardDetails(false);
      alert("Application Rejected!");
    } catch (err) {
      console.error(err);
      alert("Error rejecting application");
    }
  };

  const handleCancel = () => setShowPopup(false);

  // For optional visual delivery progress
  const deliverySteps = {
    Pending: 1,
    "Not Printed": 1,
    Printed: 2,
    Dispatched: 3,
    Delivered: 4,
  };
  const currentStep = deliverySteps[cardInfo.deliveryStatus] || 1;

  return (
    <div className="row m-0 py-2">
      {/* LEFT SIDE: Timeline */}
      <div id="progress-bar" className="col-3 py-2">
        <Timeline currentStage={stage} />
      </div>

      {/* RIGHT SIDE: Final Approval Details */}
      <div id="progress-card" className="col-9 p-4 position-relative">
        <div className="premium-info-approval">
          <div id="progress-card-header">
            <h5>Application Final Approval</h5>
          </div>

          <div className="status-row mt-3">
            <strong>Current Application Status: </strong>
            <span
              style={{
                color:
                  appStatus === "Approved"
                    ? "green"
                    : appStatus === "Rejected"
                    ? "crimson"
                    : "gray",
                marginLeft: "6px",
              }}
            >
              {appStatus || "Pending"}
            </span>
          </div>

          <div className="button-group mt-3">
            <button className="accept-btn me-2" onClick={handleAccept}>
              Accept
            </button>
            <button className="reject-btn" onClick={handleReject}>
              Reject
            </button>
          </div>
        </div>

        {/* ✅ Show card details only if approved */}
        {showCardDetails && (
          <div className="premium-card-section mt-4">
            <div className="premium-card-header">
              <h5>Credit Card Details</h5>
            </div>

            <div className="premium-layout">
              {/* LEFT: Visual Card */}
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
                    {cardInfo.maskedCardNumber ||
                      cardInfo.cardNumber ||
                      "XXXX-XXXX-XXXX-0123"}
                  </div>
                  <div className="cc-footer">
                    <span className="cc-holder">Card Holder</span>
                    <span className="cc-expiry">
                      Valid:
                      {cardInfo.expiryDate
                        ? ` ${cardInfo.expiryDate.slice(5, 7)}/${cardInfo.expiryDate.slice(2, 4)}`
                        : " --/--"}
                    </span>
                  </div>
                </div>
              </div>

              {/* RIGHT: Info */}
              <div className="premium-info-box">
                <div className="premium-info-row">
                  <span className="label">Card Type:</span>
                  <span className="value">{cardInfo.card_type || "-"}</span>
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
                  <span className="value">{cardInfo.cardStatus || "Pending"}</span>
                </div>
              </div>
            </div>

            {/* Delivery Progress Section */}
            <div className="delivery-status-container mt-4">
              <div
                className={`delivery-step ${currentStep >= 1 ? "active" : ""}`}
              >
                <span className="delivery-circle" />
                <span className="delivery-label">Not Printed</span>
              </div>
              <div className="delivery-line" />
              <div
                className={`delivery-step ${currentStep >= 2 ? "active" : ""}`}
              >
                <span className="delivery-circle" />
                <span className="delivery-label">Printed</span>
              </div>
              <div className="delivery-line" />
              <div
                className={`delivery-step ${currentStep >= 3 ? "active" : ""}`}
              >
                <span className="delivery-circle" />
                <span className="delivery-label">Dispatched</span>
              </div>
              <div className="delivery-line" />
              <div
                className={`delivery-step ${currentStep >= 4 ? "active" : ""}`}
              >
                <span className="delivery-circle" />
                <span className="delivery-label">Delivered</span>
              </div>
            </div>

            {/* Action Buttons */}
            <div className="action-btn-container mt-3">
              <button className="premium-btn print-btn">Print</button>
              <button className="premium-btn email-btn">Send Email</button>
            </div>
          </div>
        )}
      </div>

      {/* Confirmation Popup */}
      {showPopup && (
        <div className="popup-overlay">
          <div className="popup-box">
            <h5>
              <strong>Confirm Final Approval</strong>
            </h5>
            <p>
              By clicking <strong>Confirm</strong>, you approve this application
              and initiate credit card creation.
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
  );
}

export default FinalApproval;