CREATE TABLE admins (
    id SERIAL PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE patients (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    code CHAR(3) NOT NULL,
    arrival_time BIGINT NOT NULL
);

INSERT INTO admins (username, password) VALUES ('admin', 'password');

INSERT INTO patients (name, code, arrival_time) VALUES ('John Doe', 'JDO', EXTRACT(EPOCH FROM now())::bigint);
INSERT INTO patients (name, code, arrival_time) VALUES ('Jane Smith', 'JSM', EXTRACT(EPOCH FROM now())::bigint);
INSERT INTO patients (name, code, arrival_time) VALUES ('Alice Johnson', 'AJN', EXTRACT(EPOCH FROM now())::bigint);
INSERT INTO patients (name, code, arrival_time) VALUES ('Bob Brown', 'BBR', EXTRACT(EPOCH FROM now())::bigint);
INSERT INTO patients (name, code, arrival_time) VALUES ('Charlie Delta', 'CDE', EXTRACT(EPOCH FROM now())::bigint);
INSERT INTO patients (name, code, arrival_time) VALUES ('Eve Frank', 'EFR', EXTRACT(EPOCH FROM now())::bigint);
