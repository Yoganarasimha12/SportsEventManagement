const handleShow = async (row) => {
  try {
    // Fetch full Application
    const appRes = await axios.get(`http://localhost:8080/api/applications/${row.id}`);
    console.log("Full Application Details:", appRes.data);

    // Get customerId (if needed)
    const customerId =
      row.customerSummary?.customerId ??
      appRes.data.customer?.customerId ??
      null;

    // Optional: fetch customer if not included in row
    let custResData = row.customerSummary ?? null;
    if (!custResData && customerId) {
      const custRes = await axios.get(`http://localhost:8080/api/customers/${customerId}`);
      custResData = custRes.data;
    }

    // Compute currentStage and fullName
    const currentStage =
      appRes.data.currentStage ??
      row.currentStage ??
      "application-status";

    const fullName =
      (custResData?.firstName || "") +
      (custResData?.middleName ? ` ${custResData.middleName}` : "") +
      (custResData?.lastName ? ` ${custResData.lastName}` : "");

    // Navigate and pass all required data
    navigate(`/show-application/${row.id}/${currentStage}`, {
      state: {
        applicationId: row.id,
        customerId: customerId,
        currentStage,
        fullName,
      },
    });
  } catch (err) {
    console.error("Error while preparing show view:", err);
    alert("Failed to load details for show. Check console for details.");
  }
};