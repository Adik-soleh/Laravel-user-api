const request = require("supertest");

const BASE_URL = "http://127.0.0.1:8000/api";

describe("User API Endpoints", () => {
  let userId;

  test("1️⃣ GET /users → Mendapatkan daftar user", async () => {
    const res = await request(BASE_URL).get("/users");
    expect(res.statusCode).toBe(200);
    expect(Array.isArray(res.body.data)).toBeTruthy();
  });

  test("2️⃣ POST /users → Menambahkan user baru", async () => {
    const res = await request(BASE_URL)
      .post("/users")
      .send({
        name: "Jest User",
        email: `jestuser${Date.now()}@example.com`,
        age: 25,
      });

    expect(res.statusCode).toBe(201);
    expect(res.body.data).toHaveProperty("id");
    userId = res.body.data.id;
  });

  test("3️⃣ GET /users/:id → Mendapatkan user berdasarkan ID", async () => {
    await new Promise((resolve) => setTimeout(resolve, 500)); 
    const res = await request(BASE_URL).get(`/users/${userId}`);
    expect(res.statusCode).toBe(200);
    expect(res.body.data).toHaveProperty("id", userId);
  });

  test("4️⃣ PUT /users/:id → Memperbarui user", async () => {
    const res = await request(BASE_URL)
      .put(`/users/${userId}`)
      .send({ name: "Updated Jest User", age: 30 });

    expect(res.statusCode).toBe(200);
    expect(res.body.data.name).toBe("Updated Jest User");
  });

  test("5️⃣ DELETE /users/:id → Menghapus user", async () => {
    const res = await request(BASE_URL).delete(`/users/${userId}`);
    expect(res.statusCode).toBe(200);
    expect(res.body.message).toBe("User berhasil dihapus");
  });

  test("6️⃣ GET /users/:id → Harus gagal jika user sudah dihapus", async () => {
    const res = await request(BASE_URL).get(`/users/${userId}`);
    expect(res.statusCode).toBe(404);
  });
});
