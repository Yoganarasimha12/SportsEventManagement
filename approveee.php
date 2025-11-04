<div className="premium-info-approval">
  {/* Card Details Header */}
  <div id="progress-card-header" className="mb-3">
    <h5>Card Details</h5>
  </div>

  {/* Conditional layout */}
  {!isApproved ? (
    <>
      {/* Default layout - before approval */}
      <div className="d-flex justify-content-start py-2">
        <div className="premium-info-row">
          <span className="label">Card Type:</span>
          <span className="value">{applicationInfo.card_type || "-"}</span>
        </div>
      </div>

      <div className="d-flex justify-content-start py-2">
        <div className="premium-info-row">
          <span className="label">Credit Limit:</span>
          <span className="value">
            {rules.creditLimit
              ? `Rs. ${rules.creditLimit.toLocaleString()}`
              : "Rs. -"}
          </span>
        </div>
      </div>

      <div className="d-flex justify-content-start py-2">
        <div className="premium-info-row">
          <span className="label">Interest Rate:</span>
          <span className="value">
            {rules.interestRate ? `${rules.interestRate}%` : "--"}
          </span>
        </div>
      </div>
    </>
  ) : (
    <>
      {/* Approved Layout */}
      <div className="approved-info-row d-flex justify-content-between py-2">
        <div>
          <span className="label">Credit Limit:</span>
          <span className="value">
            {rules.creditLimit
              ? `Rs. ${rules.creditLimit.toLocaleString()}`
              : "Rs. -"}
          </span>
        </div>

        <div>
          <span className="label">Interest Rate:</span>
          <span className="value">
            {rules.interestRate ? `${rules.interestRate}%` : "--"}
          </span>
        </div>
      </div>

      <div className="approval-status-badge mt-3 mb-2">
        <span>Approved</span>
      </div>

      {/* You can place the credit card details section below here */}
      <div className="card-details-section mt-3">
        {/* your card details component or info */}
      </div>
    </>
  )}

  {/* Action Buttons */}
  {(!isApproved && !isRejected) && (
    <div className="action-btn-container mt-4">
      {/* buttons here */}
    </div>
  )}
</div>