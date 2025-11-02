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


dashb final

import React, { useEffect, useState } from "react";
import "./Dashboard.css";
import axios from "axios";
import { useNavigate, Link } from "react-router-dom";

function DashboardPage() {
  const navigate = useNavigate();

  // UI State
  const [applications, setApplications] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  // Derived totals
  const totalApplications = applications.length;
  const pendingApplications = applications.filter(
    (a) => (a.currentStatus ?? "").toLowerCase() === "pending"
  ).length;
  const approvedApplications = applications.filter(
    (a) => (a.currentStatus ?? "").toLowerCase() === "approved"
  ).length;
  const rejectedApplications = applications.filter(
    (a) => (a.currentStatus ?? "").toLowerCase() === "rejected"
  ).length;

  // Helper: build full name from customer object
  const buildFullName = (cust) => {
    if (!cust) return "";
    const fname = cust.firstName ?? cust.first_name ?? "";
    const mname = cust.middleName ?? cust.middle_name ?? "";
    const lname = cust.lastName ?? cust.last_name ?? "";

    if (mname && lname) return `${fname} ${mname} ${lname}`.trim();
    if (lname) return `${fname} ${lname}`.trim();
    return fname || "";
  };

  // Load all applications with customer summary (backend endpoint)
  useEffect(() => {
    let cancelled = false;

    const load = async () => {
      setLoading(true);
      setError(null);

      try {
        const res = await axios.get("http://localhost:8080/api/applications/with-customers");
        if (cancelled) return;

        const normalized = Array.isArray(res.data)
          ? res.data.map((it) => ({
              id: it.applicationId ?? it.application_id ?? it.id ?? null,
              currentStage: it.currentStage ?? it.current_stage ?? null,
              currentStatus: it.currentStatus ?? it.current_status ?? null,
              cardType: it.cardType ?? it.card_type ?? null,
              customerSummary: it.customer ?? it.customerSummary ?? null,
            }))
          : [];

        setApplications(normalized);
      } catch (err) {
        console.warn("Failed to load /api/applications/with-customers:", err.message || err);
        setApplications([]);
        setError("Failed to load applications. Make sure backend endpoint exists.");
      } finally {
        if (!cancelled) setLoading(false);
      }
    };

    load();
    return () => {
      cancelled = true;
    };
  }, []);

  // ✅ SHOW BUTTON logic (merged from working version)
  const handleShow = async (row) => {
    try {
      // Fetch full Application
      const appRes = await axios.get(`http://localhost:8080/api/applications/${row.id}`);
      console.log("Full Application Details:", appRes.data);

      // Get customerId (try from row first, then fallback)
      let customerId =
        row.customerSummary?.customerId ??
        row.customerSummary?.customer_id ??
        appRes.data.customer?.customerId ??
        appRes.data.customer_id ??
        null;

      let custResData = null;
      if (customerId) {
        try {
          const custRes = await axios.get(`http://localhost:8080/api/customers/${customerId}`);
          custResData = custRes.data;
          console.log("Full Customer Details:", custResData);
        } catch (custErr) {
          console.warn("Failed to fetch customer:", custErr.message || custErr);
        }
      }

      const currentStage =
        appRes.data.currentStage ?? appRes.data.current_stage ?? row.currentStage ?? "Unknown";

      const fullName =
        custResData?.firstName ??
        custResData?.first_name ??
        buildFullName(custResData) ??
        buildFullName(row.customerSummary);

      // ✅ Navigate to /show-application/:applicationId/:currentStage
      navigate(`/show-application/${row.id}/${currentStage}`, {
        state: {
          applicationId: row.id,
          currentStage,
          fullName,
        },
      });
    } catch (err) {
      console.error("Error while preparing Show view:", err);
      alert("Failed to load details for Show. Check console for details.");
    }
  };

  return (
    <div className="dashboard-bg">
      <div className="dashboard-main">
        {/* Summary Cards */}
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

        {/* Applications Table */}
        <div className="dashboard-table-section">
          <h2>Applications</h2>

          {loading ? (
            <p>Loading applications...</p>
          ) : error ? (
            <p style={{ color: "crimson" }}>{error}</p>
          ) : applications.length === 0 ? (
            <p>No applications found.</p>
          ) : (
            <table className="application-table">
              <thead>
                <tr>
                  <th>Application ID</th>
                  <th>Customer ID</th>
                  <th>Name</th>
                  <th>Status</th>
                  <th>Card Type</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                {applications.map((app) => (
                  <tr key={app.id}>
                    <td>{app.id}</td>
                    <td>
                      {app.customerSummary
                        ? app.customerSummary.customerId ??
                          app.customerSummary.customer_id ??
                          ""
                        : ""}
                    </td>
                    <td>
                      {app.customerSummary
                        ? buildFullName(app.customerSummary)
                        : "-"}
                    </td>
                    <td>{app.currentStatus ?? "-"}</td>
                    <td>{app.cardType ?? "-"}</td>
                    <td>
                      {/* ✅ SHOW BUTTON merged here */}
                      <button
                        className="table-btn show"
                        onClick={() => handleShow(app)}
                      >
                        Show
                      </button>

                      <Link to="/edit-application">
                        <button className="table-btn edit">Edit</button>
                      </Link>

                      <button className="table-btn delete">Delete</button>
                    </td>
                  </tr>
                ))}
              </tbody>
            </table>
          )}
        </div>
      </div>
    </div>
  );
}

export default DashboardPage;