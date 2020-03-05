package controller;

import java.io.IOException;
import java.util.Date;

import javax.persistence.EntityManager;
import javax.persistence.EntityManagerFactory;
import javax.persistence.Persistence;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import model.Circuit;
import model.Toy;

/**
 * Servlet implementation class Controller
 */
@WebServlet("/Controller")
public class Controller extends HttpServlet {
	private static final long serialVersionUID = 1L;

	/**
	 * @see HttpServlet#HttpServlet()
	 */
	public Controller() {
		super();
		// TODO Auto-generated constructor stub
	}

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse
	 *      response)
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response)
			throws ServletException, IOException {
		try {
			Class.forName("com.mysql.cj.jdbc.Driver");
		} catch (ClassNotFoundException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		if (request.getParameter("btnLoad") != null) {
			EntityManagerFactory emf = Persistence.createEntityManagerFactory("SalesmanReference");
			EntityManager em = emf.createEntityManager();

			Toy myToy = em.find(Toy.class, Integer.parseInt(request.getParameter("txtToyID")));
			request.setAttribute("toy", myToy);
		} else if (request.getParameter("btnSave") != null) {
			EntityManagerFactory emf = Persistence.createEntityManagerFactory("SalesmanReference");
			EntityManager em = emf.createEntityManager();

			Toy myToy = new Toy();
			myToy.setInspector(request.getParameter("txtInspector"));
			myToy.setInspectionTime(new Date());
			myToy.setToyCode(Integer.parseInt(request.getParameter("txtCode")));
			Circuit circuit1 = new Circuit();
			circuit1.setVoltage(Double.parseDouble(request.getParameter("txtVoltage1")));
			circuit1.setResistance(Double.parseDouble(request.getParameter("txtResistance1")));
			circuit1.setManufactureLocation(request.getParameter("txtManufactureLocation1"));
			circuit1.setCircuitNumber(1);
			myToy.addCircuit(circuit1);
			Circuit circuit2 = new Circuit();
			circuit2.setVoltage(Double.parseDouble(request.getParameter("txtVoltage2")));
			circuit2.setResistance(Double.parseDouble(request.getParameter("txtResistance2")));
			circuit2.setManufactureLocation(request.getParameter("txtManufactureLocation2"));
			circuit2.setCircuitNumber(2);
			myToy.addCircuit(circuit2);
			em.getTransaction().begin();
			em.persist(myToy);
			em.getTransaction().commit();
		} else if (request.getParameter("btnDelete") != null) {
			EntityManagerFactory emf = Persistence.createEntityManagerFactory("SalesmanReference");
			EntityManager em = emf.createEntityManager();

			em.getTransaction().begin();
			em.remove(em.find(Toy.class, Integer.parseInt(request.getParameter("txtToyID"))));
			em.getTransaction().commit();
		}
		request.getRequestDispatcher("View.jsp").forward(request, response);
	}

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse
	 *      response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response)
			throws ServletException, IOException {
		// TODO Auto-generated method stub
		doGet(request, response);
	}

}
