cardissued.js


import React, { useState, useEffect } from "react";
import axios from "axios";
import "./Timeline.css";
import "./CardIssued.css";

const CardIssued = () => {
  const cardId = 3;
  const api = `http://localhost:8080/api/creditcards/${cardId}`;

  const [cardInfo, setCardInfo] = useState({});
  const [isApproved, setIsApproved] = useState(false);
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

  const handleAccept = () => setShowPopup(true);

  const handleConfirm = () => {
    setIsApproved(true);
    setShowPopup(false);
  };

  return (
    <div className="row m-0 py-2">
      {/* Left Timeline Area */}
      <div id="progress-bar" className="col-3 py-2"></div>

      {/* Main Content */}
      <div id="progress-card" className="col-9 p-4 position-relative">
        <div className="premium-card-section">
          {/* HEADER */}
          <div className="premium-card-header">
            <h5>Credit Card Details</h5>
          </div>

          {/* Layout */}
          <div className="premium-layout">
            {/* LEFT — Credit Card UI */}
            <div className="premium-card-visual">
              <div className="credit-card-ui">
                <div className="bank-logo">
                  <img src="/Asset/Logos/try_scb_logo.png" alt="SCB Logo" />
                </div>

                <div className="chip"></div>

                <div className="cc-number">
                  {cardInfo.maskedCardNumber || "XXXX-XXXX-XXXX-0123"}
                </div>

                {isApproved && (
                  <div className="cc-footer">
                    <span className="cc-holder">
                      {cardInfo.cardHolderName || "CARD HOLDER"}
                    </span>
                    <span className="cc-expiry">
                      {cardInfo.expiryDate
                        ? `${cardInfo.expiryDate.slice(5, 7)}/${cardInfo.expiryDate.slice(2, 4)}`
                        : ""}
                    </span>
                  </div>
                )}
              </div>
            </div>

            {/* RIGHT — Info Box */}
            <div className="premium-info-box">
              <div className="premium-info-row">
                <span className="label">Card Type:</span>
                <span className="value">{cardInfo.cardType}</span>
              </div>

              <div className="premium-info-row">
                <span className="label">Issued Date:</span>
                <span className="value">
                  {isApproved
                    ? cardInfo.generatedAt?.slice(0, 10)
                    : "Pending Final Approval"}
                </span>
              </div>

              <div className="premium-info-row">
                <span className="label">Status:</span>
                <span className={`value ${isApproved ? "active-status" : "pending-status"}`}>
                  {isApproved ? "Issued" : "Awaiting Approval"}
                </span>
              </div>
            </div>
          </div>

          {/* ✅ Show Buttons ONLY WHEN NOT APPROVED */}
          {!isApproved && (
            <div className="button-group mt-4">
              <button className="accept-btn" onClick={handleAccept}>
                Accept
              </button>
              <button className="reject-btn">
                Reject
              </button>
            </div>
          )}
        </div>
      </div>

      {/* Confirm Popup */}
      {showPopup && (
        <div className="popup-overlay">
          <div className="popup-box">
            <h5>Confirm Final Approval</h5>
            <p>
              Once confirmed, the credit card will be officially <strong>Issued</strong>.
            </p>

            <div className="popup-buttons">
              <button className="confirm-btn" onClick={handleConfirm}>
                Confirm
              </button>
              <button className="cancel-btn" onClick={() => setShowPopup(false)}>
                Cancel
              </button>
            </div>
          </div>
        </div>
      )}

    </div>
  );
};

export default CardIssued;



cardissued.css

/* ✅ Popup Premium Glass Effect */
.popup-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  backdrop-filter: blur(5px);
  background: rgba(0,0,0,0.45);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 2000;
}

.popup-box {
  background: #fff;
  width: 350px;
  padding: 22px;
  border-radius: 14px;
  text-align: center;
  box-shadow: 0 6px 30px rgba(0,0,0,0.25);
  animation: popIn .3s ease-out;
}

@keyframes popIn {
  from { transform: scale(.8); opacity: 0; }
  to { transform: scale(1); opacity: 1; }
}

.popup-buttons button {
  margin: 10px 12px;
}

/* ✅ Buttons */
.accept-btn, .confirm-btn {
  background: #0473EA;
  color: white;
  padding: 10px 22px;
  border: none;
  border-radius: 8px;
  font-weight: 600;
  cursor: pointer;
}
.reject-btn, .cancel-btn {
  background: #d9534f;
  color: white;
  padding: 10px 22px;
  border: none;
  border-radius: 8px;
  cursor: pointer;
}

.accept-btn:hover, .confirm-btn:hover {
  background: #035fcc;
}
.reject-btn:hover, .cancel-btn:hover {
  background: #b64542;
}

/*  Status Text Colors */
.active-status {
  color: #0b8a34;
  font-weight: bold;
}
.pending-status {
  color: #b08d00;
  font-weight: 600;
}