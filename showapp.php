import React, { useEffect, useState } from 'react';
import { useParams } from 'react-router-dom';  // ✅ Added for dynamic routing
import Navbar from '../components/Common/Navbar/Navbar';
import Footer from '../components/Common/Footer/Footer';
import ShowApplicationHeader from '../modules/ShowApplication/ShowApplicationHeader';
import axios from 'axios';

import DocumentStatus from '../modules/ShowApplication/DocumentStatus';
import DocumentReview from '../modules/ShowApplication/DocumentReview';
import CreditCheck from '../modules/ShowApplication/CreditCheck';
import FinalApproval from '../modules/ShowApplication/FinalApproval';

const ShowApplicationPage = () => {
  // ✅ Get values from URL (example: /show-application/BL0001/final-approval)
  const { applicationId, currentStage } = useParams();

  const customerId = "CC-0002"; // Keep static for now (can be made dynamic later)
  const custApi = `http://localhost:8080/api/customers/${customerId}`;

  const [application, setApplication] = useState({});
  const [customerInfo, setCustomerInfo] = useState({});
  const [fullName, setFullName] = useState("");

  // ✅ Helper: generate full name
  const generateFullName = (fname, mname, lname) => {
    if (mname && lname) {
      return `${fname} ${mname} ${lname}`;
    } else if (lname) {
      return `${fname} ${lname}`;
    } else {
      return fname;
    }
  };

  // ✅ Fetch customer details (and nested applications)
  const loadCustomerDetails = async () => {
    try {
      const customerResponse = await axios.get(custApi);
      setCustomerInfo(customerResponse.data);
    } catch (error) {
      console.log(error);
    }
  };

  useEffect(() => {
    loadCustomerDetails();
  }, []);

  useEffect(() => {
    if (customerInfo) {
      setFullName(
        generateFullName(
          customerInfo.first_name,
          customerInfo.middle_name,
          customerInfo.last_name
        )
      );

      // ✅ Find matching application by ID
      const app = customerInfo.applications?.find(
        (a) => a.applicationId === applicationId
      );
      setApplication(app);
    }
  }, [customerInfo, applicationId]);

  // ✅ Choose which component to render based on the route param `currentStage`
  const renderCurrentStage = () => {
    switch (currentStage) {
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
        {/* ✅ ShowApplication Header */}
        <ShowApplicationHeader
          id={application?.applicationId}
          name={fullName}
          currentStatus={application?.currentStatus}
        />

        {/* ✅ Stage-based dynamic rendering */}
        {renderCurrentStage()}
      </div>

      <Footer />
    </>
  );
};

export default ShowApplicationPage;