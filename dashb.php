import React from "react";
import "./Dashboard.css";
import { Link, useNavigate } from "react-router-dom"; // ✅ fix import (was "react-router")
import axios from "axios";

// Sample data
const sampleData = [
  {
    id: "BL0001",
    customer: "CC-0002",
    name: "Aayush Panda",
    status: "In Review",
    Issue_Date: "7 days",
  },
  {
    id: "BL0002",
    customer: "CC-0003",
    name: "Sai Pawan",
    status: "Pending",
    Issue_Date: "1 day",
  },
  {
    id: "BL0003",
    customer: "CC-0004",
    name: "Koushik Jain",
    status: "In Review",
    Issue_Date: "5 days",
  },
  {
    id: "BL0004",
    customer: "CC-0005",
    name: "Yash Nagpal",
    status: "Pending",
    Issue_Date: "2 days",
  },
];

function DashboardPage() {
  const navigate = useNavigate();

  // Summary data
  const totalApplications = sampleData.length;
  const pendingApplications = sampleData.filter((app) => app.status === "Pending").length;
  const approvedApplications = 0;
  const rejectedApplications = 2;

  // Helper function to generate full name
  const generateFullName = (fname, mname, lname) => {
    if (mname && lname) return `${fname} ${mname} ${lname}`;
    if (lname) return `${fname} ${lname}`;
    return fname;
  };

  // ✅ This handles navigation to Show Application page
  const handleShow = async (app) => {
    try {
      // Fetch from backend (replace endpoints with actual ones)
      const appRes = await axios.get(`http://localhost:8080/api/applications/${app.id}`);
      const custRes = await axios.get(`http://localhost:8080/api/customers/${app.customer}`);

      console.log("Full Application Details:", appRes.data);
      console.log("Full Customer Details:", custRes.data);

      const currentStage =
        appRes.data.currentStage ?? appRes.data.current_stage ?? "application-status";

      const fullName = generateFullName(
        custRes.data.first_name,
        custRes.data.middle_name,
        custRes.data.last_name
      );

      // ✅ Navigate with params like TempButton logic
      navigate(`/show-application/${app.id}/${currentStage}`, {
        state: {
          applicationId: app.id,
          currentStage,
          fullName,
        },
      });
    } catch (error) {
      console.error("Error loading details:", error);
    }
  };

  const handleEdit = () => {};

  return (
    <div className="dashboard-bg">
      <div className="dashboard-main">
        {/* Dashboard summary cards */}
        <div className="dashboard-summary-container">
          <div className="summary-card total">
            <div className="summary-icon">&#128337;</div>
            <div className="summary-data">
              <h2>{totalApplications}</h2>
              <div>Total Applications</div>
            </div>
          </div>

          <div className="summary-card rejected">
            <div className="summary-icon">&#128200;</div>
            <div className="summary-data">
              <h2>{rejectedApplications}</h2>
              <div>Rejected Applications</div>
            </div>
          </div>

          <div className="summary-card pending">
            <div className="summary-icon">&#9203;</div>
            <div className="summary-data">
              <h2>{pendingApplications}</h2>
              <div>Pending Applications</div>
            </div>
          </div>

          <div className="summary-card approved">
            <div className="summary-icon">&#128179;</div>
            <div className="summary-data">
              <h2>{approvedApplications}</h2>
              <div>Approved Applications</div>
            </div>
          </div>
        </div>

        {/* Table of application data */}
        <div className="dashboard-table-section">
          <h2>Applications</h2>
          <table className="application-table">
            <thead>
              <tr>
                <th>Application ID</th>
                <th>Customer ID</th>
                <th>Name</th>
                <th>Status</th>
                <th>Issue Date (Days)</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              {sampleData.map((app) => (
                <tr key={app.id}>
                  <td>{app.id}</td>
                  <td>{app.customer}</td>
                  <td>{app.name}</td>
                  <td>{app.status}</td>
                  <td>{app.Issue_Date}</td>
                  <td>
                    {/* ✅ Show button triggers handleShow */}
                    <button
                      className="table-btn show"
                      onClick={() => handleShow(app)}
                    >
                      Show
                    </button>

                    <Link to={"/edit-application"}>
                      <button className="table-btn edit" onClick={handleEdit}>
                        Edit
                      </button>
                    </Link>

                    <button className="table-btn delete">Delete</button>
                  </td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      </div>
    </div>
  );
}

export default DashboardPage;