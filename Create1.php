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