handleshow

const handleShow = async (app) => {
  try {
    const appRes = await axios.get(`http://localhost:8080/api/applications/${app.id}`);
    const custRes = await axios.get(`http://localhost:8080/api/customers/${app.customer}`);

    const currentStage =
      appRes.data.currentStage ?? appRes.data.current_stage ?? "application-status";

    const fullName = generateFullName(
      custRes.data.first_name,
      custRes.data.middle_name,
      custRes.data.last_name
    );

    navigate(`/show-application/${app.id}/${currentStage}`, {
      state: { applicationId: app.id, currentStage, fullName },
    });
  } catch (error) {
    console.error("Error loading details:", error);
  }
};