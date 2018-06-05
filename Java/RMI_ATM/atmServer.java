import java.rmi.Naming;
import java.rmi.registry.LocateRegistry;

public class atmServer {

	public static void main(String[] args) {
		// TODO Auto-generated method stub
		try {
			atm callObject = new atm();
			System.setProperty("java.rmi.server.hostname","192.168.43.233"); // thay IP cua minh vao  
			LocateRegistry.createRegistry(1099);
			Naming.rebind("objectATM", callObject);
			System.out.print("Dang ky ATM_Server thanh cong");
		} catch (Exception e) {
			// TODO: handle exception
			System.out.print(e.getMessage());
		}
	}

}
