import React, { useEffect, useState } from "react";
import { Link, useParams } from "react-router-dom";
import "./Timeline.css";

const steps = [
  { name: "Application Submitted", path: "application-status" },
  { name: "Document Review", path: "document-review" },
  { name: "Credit Assessment", path: "credit-check" },
  { name: "Final Approval", path: "final-approval" },
];

const Timeline = ({ currentStage }) => {
  const [activeIndex, setActiveIndex] = useState(0);
  const { applicationId } = useParams();

  // Update timeline whenever the current stage changes
  useEffect(() => {
    if (!currentStage) return;

    const index = steps.findIndex(
      (s) => s.path.toLowerCase() === currentStage.toLowerCase()
    );
    if (index !== -1) {
      setActiveIndex(index);
    }
  }, [currentStage]);

  return (
    <div className="timeline-container">
      {steps.map((step, index) => (
        <div key={index} className="timeline-step">
          <Link
            to={`/show-application/${applicationId}/${step.path}`}
            className="timeline-link"
          >
            <div
              className={`circle ${
                index === activeIndex
                  ? "active"
                  : index < activeIndex
                  ? "completed"
                  : ""
              }`}
            >
              <span className="circle-number">{index + 1}</span>
            </div>
          </Link>

          <div
            className={`step-text ${
              index === activeIndex
                ? "active-text"
                : index < activeIndex
                ? "completed-text"
                : ""
            }`}
          >
            {step.name}
          </div>

          {/* Connector line between steps */}
          {index < steps.length - 1 && (
            <div
              className={`line ${
                index < activeIndex ? "active-line" : ""
              }`}
            ></div>
          )}
        </div>
      ))}
    </div>
  );
};

export default Timeline;