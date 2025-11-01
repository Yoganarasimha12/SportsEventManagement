import React, { useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";
import axios from "axios";

const TempButton = () => {
  const navigate = useNavigate();

  // Mocked DB Data — for testing you can later replace this with your real API
  const [applications, setApplications] = useState([]);

  // Simulate fetching data from DB
  useEffect(() => {
    // ---- Option 1: Use a mock static array ----
    const mockData = [
      {
        applicationId: "BL0001",
        applicantName: "John Doe",
        currentStage: "application-status",
      },
      {
        applicationId: "BL0002",
        applicantName: "Jane Smith",
        currentStage: "credit-check",
      },
    ];

    setApplications(mockData);

    // ---- Option 2 (optional): Connect to your API ----
    // axios.get("http://localhost:8080/api/applications")
    //   .then((res) => setApplications(res.data))
    //   .catch((err) => console.error(err));
  }, []);

  const handleClick = (applicationId, currentStage) => {
    // Navigate dynamically to correct route
    navigate(`/show-application/${applicationId}/${currentStage}`);
  };

  return (
    <div style={{ padding: "20px" }}>
      <h3>Temporary Dashboard (Testing Routing)</h3>
      {applications.map((app) => (
        <div
          key={app.applicationId}
          style={{
            margin: "10px 0",
            padding: "10px",
            border: "1px solid #ccc",
            borderRadius: "8px",
            width: "300px",
          }}
        >
          <h4>{app.applicantName}</h4>
          <p>Application ID: {app.applicationId}</p>
          <p>Stage: {app.currentStage}</p>

          <button
            onClick={() => handleClick(app.applicationId, app.currentStage)}
            style={{
              padding: "8px 12px",
              borderRadius: "5px",
              backgroundColor: "#1b4d89",
              color: "white",
              border: "none",
              cursor: "pointer",
            }}
          >
            Show Application
          </button>
        </div>
      ))}
    </div>
  );
};

export default TempButton;