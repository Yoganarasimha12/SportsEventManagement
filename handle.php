// 🟢 Modified handleConfirm
const handleConfirm = async () => {
  try {
    // backend call to mark application as approved
    await axios.put(`http://localhost:8080/api/applications/${applicationId}/approve`);

    // update UI
    setIsApproved(true);
    setShowPopup(false);
    alert("Final approval confirmed. Card process initiated.");
  } catch (error) {
    console.error("Error approving application:", error);
    alert("Failed to approve. Check console for details.");
  }
};