import React, { useEffect, useState } from "react";
import { useParams, useLocation } from "react-router-dom";
import axios from "axios";

import Navbar from "../components/Common/Navbar/Navbar";
import Footer from "../components/Common/Footer/Footer";
import ShowApplicationHeader from "../modules/ShowApplication/ShowApplicationHeader";

import DocumentStatus from "../modules/ShowApplication/DocumentStatus";
import DocumentReview from "../modules/ShowApplication/DocumentReview";
import CreditCheck from "../modules/ShowApplication/CreditCheck";
import FinalApproval from "../modules/ShowApplication/FinalApproval";

import "../modules/ShowApplication/ShowApplication.css";

const ShowApplicationPage = () => {
  // --- ROUTE PARAMS AND STATE FROM NAVIGATION ---
  const { applicationId, currentStage } = useParams();
  const location = useLocation();

  // Data passed from DashboardPage navigate() call
  const { customerId, fullName: passedFullName } = location.state || {};

  // --- STATE VARIABLES ---
  const [application, setApplication] = useState({});
  const [customerInfo, setCustomerInfo] = useState({});
  const [fullName, setFullName] = useState(passedFullName || "");

  // --- HELPERS ---
  const generateFullName = (fname, mname, lname) => {
    if (mname && lname) return `${fname} ${mname} ${lname}`.trim();
    if (lname) return `${fname} ${lname}`.trim();
    return fname || "";
  };

  // --- FETCH CUSTOMER DETAILS ---
  const loadCustomerDetails = async () => {
    if (!customerId) return;
    try {
      const res = await axios.get(`http://localhost:8080/api/customers/${customerId}`);
      setCustomerInfo(res.data);
      setFullName(
        generateFullName(res.data.first_name, res.data.middle_name, res.data.last_name)
      );
    } catch (error) {
      console.error("Error loading customer details:", error);
    }
  };

  // --- FETCH APPLICATION DETAILS ---
  const loadApplicationDetails = async () => {
    if (!applicationId) return;
    try {
      const res = await axios.get(`http://localhost:8080/api/applications/${applicationId}`);
      setApplication(res.data);
    } catch (error) {
      console.error("Error loading application details:", error);
    }
  };

  // --- EFFECTS ---
  useEffect(() => {
    loadCustomerDetails();
    loadApplicationDetails();
  }, [applicationId, customerId]);

  // --- RENDER STAGE-BASED COMPONENT ---
  const renderCurrentStage = () => {
    switch ((currentStage || "").toLowerCase()) {
      case "application-status":
        return <DocumentStatus applicationInfo={application} />;
      case "document-review":
        return <DocumentReview applicationInfo={application} />;
      case "credit-check":
        return <CreditCheck applicationInfo={application} />;
      case "final-approval":
        return <FinalApproval applicationInfo={application} />;
      default:
        return <DocumentStatus applicationInfo={application} />;
    }
  };

  return (
    <>
      <Navbar />
      <div id="us5-page">
        {/* Header Section */}
        <ShowApplicationHeader
          id={application?.applicationId}
          name={fullName}
          currentStatus={application?.currentStatus}
        />

        {/* Dynamic Section Based on Stage */}
        {renderCurrentStage()}
      </div>
      <Footer />
    </>
  );
};

export default ShowApplicationPage;