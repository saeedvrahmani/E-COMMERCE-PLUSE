import { useState } from "react";

import Grid from "@mui/material/Grid";
import Card from "@mui/material/Card";
import Divider from "@mui/material/Divider";

import MDTypography from "components/MDTypography";
import MDBox from "components/MDBox";
import MDInput from "components/MDInput";
import MDButton from "components/MDButton";

export default function Setting() {

  const [form, setForm] = useState({
    site_title: "laravel",
    phone: "+90 553 846 2567",
    fax: "+90 553 846 2567",
    email: "hosseinhaghparast0@gmail.com",
    address: "turkey , Antalya",
    description: "laravel E-commerce",
    logo: null,
    icon: null,
  });

  const handleChange = (e) => {
    const { name, value, files } = e.target;
    setForm((prev) => ({
      ...prev,
      [name]: files ? files[0] : value,
    }));
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    console.log("📌 Submited Data:", form);

    // ⚠️ اینجا درخواست Axios‌ برای ذخیره در Laravel قرار می‌گیرد
    // axios.post("/api/settings", form)
  };

  return (
    <MDBox py={3}>
      <Grid container justifyContent="center">

        <Grid item xs={12} md={8}>
          <Card sx={{ p: 3 }}>

            <MDTypography variant="h5" fontWeight="bold" mb={1}>
              Site Settings ⚙️
            </MDTypography>
            <Divider sx={{ mb: 3 }} />

            <form onSubmit={handleSubmit}>

              <Grid container spacing={2}>

                <Grid item xs={12}>
                  <MDInput
                    label="Site Title"
                    fullWidth
                    name="site_title"
                    value={form.site_title}
                    onChange={handleChange}
                  />
                </Grid>

                <Grid item xs={12} md={6}>
                  <MDInput
                    label="Site Phone"
                    fullWidth
                    name="phone"
                    value={form.phone}
                    onChange={handleChange}
                  />
                </Grid>

                <Grid item xs={12} md={6}>
                  <MDInput
                    label="Site Fax"
                    fullWidth
                    name="fax"
                    value={form.fax}
                    onChange={handleChange}
                  />
                </Grid>

                <Grid item xs={12}>
                  <MDInput
                    label="Site Email"
                    fullWidth
                    name="email"
                    value={form.email}
                    onChange={handleChange}
                  />
                </Grid>

                <Grid item xs={12}>
                  <MDInput
                    label="Site Address"
                    fullWidth
                    name="address"
                    value={form.address}
                    onChange={handleChange}
                  />
                </Grid>

                <Grid item xs={12}>
                  <MDInput
                    label="Site Description"
                    fullWidth
                    multiline
                    rows={3}
                    name="description"
                    value={form.description}
                    onChange={handleChange}
                  />
                </Grid>

                <Grid item xs={12} md={6}>
                  <MDTypography fontWeight="medium">Logo Upload:</MDTypography>
                  <input
                    type="file"
                    accept="image/*"
                    name="logo"
                    onChange={handleChange}
                  />
                </Grid>

                <Grid item xs={12} md={6}>
                  <MDTypography fontWeight="medium">Favicon / Icon:</MDTypography>
                  <input
                    type="file"
                    accept="image/*"
                    name="icon"
                    onChange={handleChange}
                  />
                </Grid>

                <Grid item xs={12} mt={2}>
                  <MDButton type="submit" variant="gradient" color="info" fullWidth>
                    Save Settings 💾
                  </MDButton>
                </Grid>

              </Grid>
            </form>

          </Card>
        </Grid>
      </Grid>
    </MDBox>
  );
}
