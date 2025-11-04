<div className="delivery-status-container mb-4">
  {/* Title above timeline */}
  <div className="delivery-status-title">Delivery Status</div>

  {/* Horizontal timeline */}
  <div className="delivery-timeline">
    {["Generated", "Printed", "Dispatched", "Delivered"].map((step, index) => {
      const stepNumber = index + 1;
      const isActive = stepNumber <= currentStep;

      return (
        <React.Fragment key={step}>
          <div className={`delivery-step ${isActive ? "active" : ""}`}>
            <div className="delivery-circle"></div>
            <div className="delivery-label">{step}</div>
          </div>

          {index < 3 && (
            <div className={`delivery-line ${isActive ? "active" : ""}`}></div>
          )}
        </React.Fragment>
      );
    })}
  </div>
</div>


css

.delivery-status-container {
  display: flex;
  flex-direction: column; /* Stack title and timeline vertically */
  align-items: center; /* Center-align everything */
  width: 100%;
}

.delivery-status-title {
  color: #0473EA;
  font-size: 22px;
  font-weight: 600;
  padding-bottom: 12px;
  margin-bottom: 20px;
  border-bottom: 2px solid #edf2f7;
  width: 100%;
  text-align: left; /* or center if you want centered */
}

.delivery-timeline {
  display: flex;
  justify-content: space-between;
  align-items: center;
  width: 100%;
}