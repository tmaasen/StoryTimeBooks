package controller;

import java.io.IOException;

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
	 * Default constructor.
	 */
	public Controller() {
		// TODO Auto-generated constructor stub
	}

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse
	 *      response)
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response)
			throws ServletException, IOException {

//		Toy myToy = new Toy();
//		Circuit myCircuit = new Circuit();
//		
//		myToy.setInspector(request.getParameter("inspector"));
//		myToy.setToyId(Integer.parseInt(request.getParameter("toyid")));
		// myToy.setCircuits(myToy.getCircuits().add(arg0));

		if (request.getParameter("btnLoad") != null) {
			EntityManagerFactory emf = Persistence.createEntityManagerFactory("TalkingSalesman");
			EntityManager em = emf.createEntityManager();

			Toy myToy = new Toy();
			myToy = em.find(Toy.class, request.getParameter("toyid"));
			request.setAttribute("toy", myToy);
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
