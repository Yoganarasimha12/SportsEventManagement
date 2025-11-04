<div className="delivery-status-container">
  <div className="delivery-status-title">Delivery Status</div>

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
  flex-direction: column; /* Stack title + timeline vertically */
  width: 100%;
  align-items: center;
  justify-content: flex-start;
  margin-top: 25px;
  background: #ffffff;
  padding: 22px 30px;
  border-radius: 12px;
  border-left: 5px solid #0473EA;
  box-shadow: 0 4px 18px rgba(0, 0, 0, 0.15);
  height: 160px;
  margin-bottom: 45px;
}

.delivery-status-title {
  color: #0473EA;
  font-size: 22px;
  font-weight: 600;
  padding-bottom: 12px;
  margin-bottom: 20px;
  border-bottom: 2px solid #edf2f7;
  width: 100%;
  text-align: left;
}

/* 👇 NEW WRAPPER FOR TIMELINE */
.delivery-timeline {
  display: flex;
  justify-content: space-between;
  align-items: center;
  width: 100%;
}

/* Keep your existing styles for steps */
.delivery-step {
  display: flex;
  align-items: center;
  width: 25%;
  flex-direction: column;
  position: relative;
}

.delivery-circle {
  width: 26px;
  height: 26px;
  border: 3px solid #8fa6c5;
  border-radius: 50%;
  background-color: #e5eaf0;
  transition: 0.3s ease-in-out;
}

.delivery-step.active .delivery-circle {
  background: #38D200;
  border-color: #00A97F;
  box-shadow: 0 0 12px rgba(0, 200, 150, 0.6);
}

.delivery-label {
  font-size: 13px;
  font-weight: 600;
  color: #1a2b5f;
  margin-top: 8px;
  opacity: 0.55;
  transition: 0.3s;
  text-align: center;
}

.delivery-step.active .delivery-label {
  opacity: 1;
  color: #00704A;
}

.delivery-line {
  flex-grow: 1;
  height: 3px;
  background: #c6d3e6;
  margin: 0 6px;
  transition: 0.3s ease-in-out;
  margin-top: -20px;
}

.delivery-step.active + .delivery-line {
  background: #00A97F;
}